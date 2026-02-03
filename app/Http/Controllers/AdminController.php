<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function dashboard()
    {
        $today = date('Y-m-d');

        $hadirToday = Absensi::whereDate('tanggal', $today)
            ->whereNotNull('status_hadir')
            ->count();

        $alpaToday = Absensi::whereDate('tanggal', $today)
            ->where('status_hadir', 'alpa')
            ->count();

        $izinToday = Absensi::whereDate('tanggal', $today)
            ->where('jenis', 'izin')
            ->where('status_izin', 'diterima')
            ->whereNull('status_hadir')
            ->count();

        $sakitToday = Absensi::whereDate('tanggal', $today)
            ->where('jenis', 'sakit')
            ->where('status_izin', 'diterima')
            ->whereNull('status_hadir')
            ->count();

        $totalUsers = User::count();

        $permohonanPending = Absensi::whereDate('tanggal', $today)
            ->whereIn('jenis', ['izin', 'sakit'])
            ->where('status_izin', 'pending')
            ->count();

        $absensiToday = Absensi::with('user')
            ->whereDate('tanggal', $today)
            ->whereIn('status_hadir', ['hadir', 'terlambat'])
            ->orderBy('jam', 'desc')
            ->get();

        $settings  = Setting::pluck('value', 'key');
        $jamMasuk  = $settings['jam_masuk'];
        $toleransi = (int) $settings['toleransi_telat'];

        $jamBatas = Carbon::createFromFormat('H:i', $jamMasuk)
            ->addMinutes($toleransi)
            ->format('H:i');

        return view('admin.dashboard', compact(
            'hadirToday',
            'izinToday',
            'sakitToday',
            'alpaToday',
            'totalUsers',
            'absensiToday',
            'permohonanPending',
            'jamBatas',
            'settings'
        ));
    }

    public function permohonanIzin()
    {
        $today = date('Y-m-d');
        
        $permohonan = Absensi::with('user')
            ->whereDate('tanggal', $today)
            ->whereIn('jenis', ['izin', 'sakit'])
            ->where('status_izin', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $countIzin = 0;
        $countSakit = 0;
        
        foreach ($permohonan as $p) {
            if ($p->jenis == 'izin' || (str_contains(strtolower($p->keterangan ?? ''), 'izin'))) {
                $countIzin++;
            } elseif ($p->jenis == 'sakit' || (str_contains(strtolower($p->keterangan ?? ''), 'sakit'))) {
                $countSakit++;
            }
        }

        return view('admin.permohonan_izin', compact('permohonan', 'countIzin', 'countSakit'));
    }

    public function riwayatAbsensi(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $query = Absensi::with('user');

        if ($filter === 'today') {
            $query->whereDate('tanggal', date('Y-m-d'));
        } elseif ($filter === 'week') {
            $query->whereBetween('tanggal', [
                date('Y-m-d', strtotime('-7 days')),
                date('Y-m-d')
            ]);
        } elseif ($filter === 'month') {
            $query->whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'));
        }

        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('bidang')) {
            $query->where('bidang', $request->bidang);
        }

        $riwayat = $query
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->paginate(20);

        return view('admin.riwayat', compact('riwayat', 'filter'));
    }

    public function setujuiPermohonan($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'status_izin' => 'diterima'
        ]);

        return back()->with('success', 'Permohonan berhasil disetujui');
    }

    public function tolakPermohonan($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'status_izin' => 'ditolak',
            'status_hadir' => 'alpa',
            'jenis'        => null,
        ]);

        return back()->with('success', 'Permohonan berhasil ditolak');
    }

public function pengaturan(Request $request)
{
    if ($request->isMethod('post')) {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()
            ->route('admin.pengaturan')
            ->with('success', 'Pengaturan berhasil disimpan');
    }

    $settings = Setting::pluck('value', 'key');
    return view('admin.pengaturan', compact('settings'));
}
}