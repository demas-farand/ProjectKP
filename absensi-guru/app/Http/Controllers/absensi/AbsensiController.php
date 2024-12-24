<?php

namespace App\Http\Controllers\Absensi;
use App\Http\Controllers\Controller;
use App\Models\absensi\Absensi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AbsensiController extends Controller
{

    private $validApiKeys = ['1234', '200OK']; // Daftar API Key yang valid

    public function index()
    {
        $absensi = Absensi::all();
        return view('absensi.index', compact('absensi'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
        ]);

        $absensi = Absensi::where('id_guru', $request->id_guru)
            ->whereDate('jam_masuk', now()->toDateString())
            ->first();

        if ($absensi) {
            return response()->json([
                'message' => 'Sudah melakukan check-in hari ini',
            ], 400);
        }

        $absensi = new Absensi();
        $absensi->id_guru = $request->id_guru;
        $absensi->jam_masuk = now()->toDateTimeString();
        $absensi->keterangan = 'Hadir';
        $absensi->save();

        return response()->json([
            'message' => 'Berhasil check-in',
            'data' => $absensi
        ], 201);
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
        ]);

        $absensi = Absensi::where('id_guru', $request->id_guru)
            ->whereDate('jam_masuk', now()->toDateString())
            ->first();

        if (!$absensi) {
            return response()->json([
                'message' => 'Belum melakukan check-in hari ini',
            ], 400);
        }

        $absensi->jam_keluar = now()->toDateTimeString();
        $absensi->save();

        return response()->json([
            'message' => 'Berhasil check-out',
            'data' => $absensi
        ], 200);
    }

    public function mobileCheckIn(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // Validasi API Key
        if (!in_array($data['api_key'], $this->validApiKeys)) {
            return response()->json(['error' => 'API Key tidak valid'], 403);
        }

        // Validasi dan simpan data absensi
        $absensi = Absensi::where('id_guru', $data['id_guru'])
            ->whereDate('jam_masuk', now()->toDateString())
            ->first();

        if ($absensi) {
            return response()->json(['message' => 'Sudah melakukan check-in hari ini'], 400);
        }

        $absensi = new Absensi();
        $absensi->id_guru = $data['id_guru'];
        $absensi->jam_masuk = now()->toDateTimeString();
        $absensi->keterangan = 'Hadir';
        $absensi->save();

        return response()->json(['message' => 'Berhasil check-in', 'data' => $absensi], 201);
    }

}
