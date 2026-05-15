<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return view('admin.attendance.index', compact('classes'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
        ]);

        $class = SchoolClass::with('students')->findOrFail($request->class_id);
        $date = $request->date;

        // Check if attendance already exists for this day to pre-fill
        $existingRecords = Attendance::where('class_id', $class->id)
            ->whereDate('date', $date)
            ->get()
            ->keyBy('user_id');

        return view('admin.attendance.create', compact('class', 'date', 'existingRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,late',
        ]);

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'user_id' => $studentId,
                    'class_id' => $request->class_id,
                    'date' => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance recorded successfully.');
    }
}
