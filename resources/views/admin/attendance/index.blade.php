@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <h1 class="card-title">Record Attendance</h1>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">Select a class and date to begin recording attendance.</p>

        @if(session('success'))
            <div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.attendance.create') }}" method="GET">
            <div class="form-group">
                <label class="form-label">Select Class</label>
                <select name="class_id" class="form-control" required>
                    <option value="">-- Choose Class --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Select Date</label>
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Continue to Mark Attendance</button>
        </form>
    </div>
</div>
@endsection
