<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi\Absensi;
use App\Models\Absensi\Guru;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generateQRCode($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json(['error' => 'Data guru tidak ditemukan'], 404);
        }

        $qrData = [
            'id_guru' => $guru->id,
            'nama' => $guru->nama,
            'email' => $guru->email,
            'no_telp' => $guru->no_telp,
            'mata_pelajaran' => $guru->mata_pelajaran,
        ];

        // Generate QR Code from guru data
        $qrCode = QrCode::size(300)->generate(json_encode($qrData));

        return response($qrCode, 200)->header('Content-Type', 'image/svg+xml');
    }

    public function calculateDistance(Request $request)
    {
        $lat1 = $request->input('lat1');
        $lon1 = $request->input('lon1');
        $lat2 = $request->input('lat2');
        $lon2 = $request->input('lon2');

        $earthRadius = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return response()->json(['distance' => $distance]);
    }

    public function validateAttendance(Request $request)
    {
        $distance = $this->calculateDistance($request)->getData()->distance;
        $maxDistance = 0.1; // Example maximum distance in kilometers

        if ($distance <= $maxDistance) {
            // Logic to record attendance
            $absensi = new Absensi();
            $absensi->id_guru = $request->input('id_guru');
            $absensi->mata_pelajaran = $request->input('mata_pelajaran');
            $absensi->lokasi = $request->input('lokasi');
            $absensi->jam_masuk = now();
            $absensi->jam_keluar = null; // Set this if you have a check-out process
            $absensi->keterangan = $request->input('keterangan', ''); // Default to empty if not provided
            $absensi->save();

            return response()->json(['success' => 'Absensi berhasil dicatat']);
        } else {
            return response()->json(['error' => 'Jarak terlalu jauh untuk absensi'], 400);
        }
    }
}
