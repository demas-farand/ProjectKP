<?php

namespace App\Http\Controllers\Absensi;
use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAPIToken;
use App\Models\absensi\Teacher;
use App\Models\absensi\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{

    public function index(Request $request)
    {
        Log::info('Accessing index method in TeacherController');

        $query = Teacher::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('subject', 'LIKE', "%{$search}%");
        }

        $teachers = $query->get();
        $teachers = Teacher::all();
        $data = [
            'status' => 200,
            'teachers' => $teachers
        ];
        Log::info('Number of teachers found: ' . $teachers->count());
        //return response()->json($data, 200);
        return view('absensi.guru.index', compact('teachers'));

    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone_number' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
        ]);

        $teacher = Teacher::create($validatedData);


        return response()->json($teacher, 201);

    }

    public function create()
    {
        return view('absensi.guru.create');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('absensi.guru.edit', compact('teacher'));
    }

    public function show($id)
    {
        return Teacher::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:teachers,email,' . $teacher->id,
            'phone_number' => 'sometimes|required|string|max:15',
            'subject' => 'sometimes|required|string|max:255',
        ]);

        $teacher->update($validatedData);

        return response()->json($teacher, 200);
    }


    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json(null, 204);
    }

    public function absen($id)
    {
        Log::info('Attempting to absen teacher with ID: ' . $id);

        try {
            $teacher = Teacher::findOrFail($id);
            Log::info('Teacher found: ' . $teacher->name);

            $absensi = new Attendance();
            $absensi->teacher_id = $teacher->id;
            $absensi->date = now()->toDateString();
            $absensi->check_in_time = now()->toTimeString();
            $absensi->status = 'Hadir';
            $absensi->remarks = 'Checked in';
            $absensi->save();

            Log::info('Absen recorded for teacher ID: ' . $id);

            return response()->json(['message' => 'Absen berhasil'], 200);
        } catch (\Exception $e) {
            Log::error('Error during absen: ' . $e->getMessage());
            return response()->json(['message' => 'Error during absen'], 500);
        }
    }
}
