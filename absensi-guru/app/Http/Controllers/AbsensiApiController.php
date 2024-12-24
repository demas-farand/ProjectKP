<?php

namespace App\Http\Controllers;
use App\Models\Absensi\Absensi;
use App\Models\Absensi\Guru;

use Illuminate\Http\Request;

class AbsensiApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
            'mata_pelajaran' => 'required|string',
            'lokasi' => 'required|string',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ]);

        $absensi = Absensi::create([
            'id_guru' => $request->id_guru,
            'mata_pelajaran' => $request->mata_pelajaran,
            'lokasi' => $request->lokasi,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['message' => 'Absensi berhasil disimpan', 'data' => $absensi], 201);
    }
}
