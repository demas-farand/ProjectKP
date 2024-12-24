<?php

namespace App\Http\Controllers\Absensi;
use App\Http\Controllers\Controller;
use App\Models\absensi\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GuruController extends Controller
{
    private $validApiKeys = ['1234', '200OK'];
    public function index(Request $request)
    {

        Log::info('Accessing index method in TeacherController');
        $query = Guru::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('no_telp', 'LIKE', "%{$search}%")
                ->orWhere('mata_pelajaran', 'LIKE', "%{$search}%");
        }

        $guru = $query->get();
        Log::info('Number of teachers found: ' . $guru->count());

        return view('absensi.guru.index', compact('guru'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email',
            'no_telp' => 'required|string|max:15',
            'mata_pelajaran' => 'required|string|max:255',
        ]);

        $guru = Guru::create($validatedData);
        return response()->json($guru, 201);
    }

    public function create()
    {
        return view('absensi.guru.create');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('absensi.guru.edit', compact('guru'));
    }

    public function show($id)
    {
        return Guru::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:guru,email,' . $guru->id,
            'no_telp' => 'sometimes|required|string|max:15',
            'mata_pelajaran' => 'sometimes|required|string|max:255',
        ]);

        $guru->update($validatedData);
        return response()->json($guru, 200);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return response()->json(null, 204);
    }

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

        $qrCode = QrCode::format('png')->size(300)->generate(json_encode($qrData));

        return response($qrCode, 200)->header('Content-Type', 'image/png');
    }
}
