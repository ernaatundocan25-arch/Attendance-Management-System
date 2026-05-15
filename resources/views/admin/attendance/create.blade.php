@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 class="card-title" style="margin: 0;">Attendance: {{ $class->name }}</h1>
            <p style="color: var(--text-muted); margin-top: 0.25rem;">Date: {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
        </div>
        <a href="{{ route('admin.attendance.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Back</a>
    </div>

    <form action="{{ route('admin.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="class_id" value="{{ $class->id }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 2rem;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f1f5f9; text-align: left;">
                        <th style="padding: 1rem;">Student Name</th>
                        <th style="padding: 1rem; text-align: center;">Present</th>
                        <th style="padding: 1rem; text-align: center;">Absent</th>
                        <th style="padding: 1rem; text-align: center;">Late</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($class->students as $student)
                        @php
                            $status = $existingRecords->get($student->id)->status ?? 'present';
                        @endphp
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 1rem; font-weight: 500;">{{ $student->name }}</td>
                            <td style="padding: 1rem; text-align: center;">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="present" {{ $status == 'present' ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                            </td>
                            <td style="padding: 1rem; text-align: center;">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="absent" {{ $status == 'absent' ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                            </td>
                            <td style="padding: 1rem; text-align: center;">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="late" {{ $status == 'late' ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                                No students assigned to this class. <a href="{{ route('admin.classes.edit', $class) }}">Assign students now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($class->students->count() > 0)
            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2.5rem; font-size: 1rem;">Save Attendance</button>
            </div>
        @endif
    </form>
</div>
@endsection
