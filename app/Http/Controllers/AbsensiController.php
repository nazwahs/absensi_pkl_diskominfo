<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $user  = auth()->user();
        $now   = Carbon::now();
        $today = $now->toDateString();

        if (!in_array($request->type, ['hadir', 'izin'])) {
            return back()->with('error', 'Tipe absensi tidak valid.');
        }

        if ($request->type === 'hadir') {

            $sudahAbsen = Absensi::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->whereIn('status_hadir', ['hadir', 'terlambat'])
                ->exists();

            if ($sudahAbsen) {
                return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
            }

            $request->validate([
                'type'   => 'required|in:hadir',
                'bidang' => 'required',
                'foto'   => 'required|string',
                'alamat' => 'required',
            ]);

            $fotoBase64 = preg_replace(
                '#^data:image/\w+;base64,#i',
                '',
                $request->foto
            );

            $fotoBinary = base64_decode($fotoBase64);

            if ($fotoBinary === false) {
                return back()->with('error', 'Foto tidak valid.');
            }

            $fotoName = time() . '_' . $user->id . '.jpg';
            $fotoPath = 'foto_absensi/' . $fotoName;

            Storage::disk('public')->put($fotoPath, $fotoBinary);

            $jamMasuk  = Setting::where('key', 'jam_masuk')->value('value');
            $toleransi = (int) (Setting::where('key', 'toleransi_telat')->value('value') ?? 0);

            $batasMasuk = Carbon::createFromFormat('H:i', $jamMasuk)
                ->addMinutes($toleransi);

            $statusHadir = $now->greaterThan($batasMasuk)
                ? 'terlambat'
                : 'hadir';

            Absensi::create([
                'user_id'      => $user->id,
                'nama_lengkap' => $user->name,
                'bidang'       => $request->bidang,
                'foto'         => $fotoPath,
                'alamat'       => $request->alamat,
                'jam'          => $now->format('H:i'),
                'tanggal'      => $today,
                'hari'         => $now->translatedFormat('l'),
                'status_hadir' => $statusHadir,
                'status_izin'  => null,
                'jenis'        => null,
                'keterangan'   => null,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Absensi berhasil.');
        }

        if ($request->type === 'izin') {

            $sudahIzin = Absensi::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->whereNotNull('jenis')
                ->exists();

            if ($sudahIzin) {
                return back()->with('error', 'Anda sudah mengajukan izin/sakit hari ini.');
            }

            $request->validate([
                'type'       => 'required|in:izin',
                'jenis'      => 'required|in:izin,sakit',
                'keterangan' => 'required|min:4',
                'foto'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $fotoPath = $request->file('foto')
                ->store('foto_izin', 'public');

            Absensi::create([
                'user_id'      => $user->id,
                'nama_lengkap' => $user->name,
                'bidang'       => $user->bidang,
                'foto'         => $fotoPath,
                'alamat'       => null,
                'jam'          => $now->format('H:i'),
                'tanggal'      => $today,
                'hari'         => $now->translatedFormat('l'),
                'jenis'        => $request->jenis,
                'status_izin'  => 'pending',
                'status_hadir' => null,
                'keterangan'   => $request->keterangan,
            ]);

            return redirect()->route('user.izin-sakit')->with(
                'success',
                'Permohonan ' . $request->jenis . ' berhasil diajukan.'
            );
        }
    }
}