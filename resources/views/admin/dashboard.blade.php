@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Admin Dashboard</h1>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Welcome back, Admin. Use the quick links below to manage the system.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ \App\Models\User::where('role', 'student')->count() }}</div>
            <div class="stat-label">Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ \App\Models\SchoolClass::count() }}</div>
            <div class="stat-label">Classes</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ \App\Models\Attendance::whereDate('date', today())->count() }}</div>
            <div class="stat-label">Today's Attendance</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
        <div class="card" style="padding: 1.5rem; text-align: center;">
            <h3>Manage Students</h3>
            <p>Add, edit, or remove students from the system.</p>
            <a href="{{ route('admin.students.index') }}" class="btn btn-primary">Go to Students</a>
        </div>
        <div class="card" style="padding: 1.5rem; text-align: center;">
            <h3>Manage Classes</h3>
            <p>Create classes and assign students to sections.</p>
            <a href="{{ route('admin.classes.index') }}" class="btn btn-primary">Go to Classes</a>
        </div>
        <div class="card" style="padding: 1.5rem; border-style: dashed; text-align: center;">
            <h3>Mark Attendance</h3>
            <p>Record daily attendance for any class.</p>
            <a href="#" class="btn btn-primary" style="opacity: 0.5; cursor: not-allowed;">Available in Phase 4</a>
        </div>
    </div>
</div>
@endsection
