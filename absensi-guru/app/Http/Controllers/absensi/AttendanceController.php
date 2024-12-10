<?php

namespace App\Http\Controllers\Absensi;
use App\Http\Controllers\Controller;
use App\Models\absensi\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::all();
        return view('absensi.index', compact('attendance'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:guru,id',
        ]);

        $attendance = Attendance::where('teacher_id', $request->teacher_id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance) {
            return response()->json([
                'message' => 'Sudah melakukan check-in hari ini',
            ], 400);
        }

        $attendance = new Attendance();
        $attendance->teacher_id = $request->teacher_id;
        $attendance->date = now()->toDateString();
        $attendance->check_in_time = now()->toTimeString();
        $attendance->status = 'Present';
        $attendance->save();

        return response()->json([
            'message' => 'Berhasil check-in',
            'data' => $attendance
        ], 201);
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:guru,id',
        ]);

        $attendance = Attendance::where('teacher_id', $request->teacher_id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return response()->json([
                'message' => 'Belum melakukan check-in hari ini',
            ], 400);
        }

        $attendance->check_out_time = now()->toTimeString();
        $attendance->save();

        return response()->json([
            'message' => 'Berhasil check-out',
            'data' => $attendance
        ], 200);
    }
}
