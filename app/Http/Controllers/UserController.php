<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->where('status_hadir',  ['hadir', 'terlambat'])
            ->first();

        return view('user.dashboard', [
            'sudahAbsen' => $absensiHariIni !== null,
            'absensiHariIni' => $absensiHariIni
        ]);
    }

    public function izinSakit()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $permohonanHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->whereNotNull('status_izin')
            ->whereIn('status_izin', ['pending', 'diterima', 'ditolak'])
            ->latest()
            ->first();

        return view('user.izin_sakit', [
            'sudahIzinSakit' => $permohonanHariIni !== null,
            'permohonanHariIni' => $permohonanHariIni
        ]);
    }

    public function riwayat(Request $request)
    {
        $user = auth()->user();
        $filter = $request->get('filter', 'month');

        $query = Absensi::where('user_id', $user->id);

        if ($filter === 'today') {
            $query->whereDate('tanggal', today());
        } elseif ($filter === 'week') {
            $query->whereBetween('tanggal', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        } elseif ($filter === 'month') {
            $query->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year);
        }

        $riwayat = $query->orderBy('tanggal', 'desc')
                        ->orderBy('jam', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        return view('user.riwayat', compact('riwayat', 'filter'));
    }
}