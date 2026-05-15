@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">My Attendance Dashboard</h1>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Welcome, {{ Auth::user()->name }}. Here is your attendance overview.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">0</div>
            <div class="stat-label">Present</div>
        </div>
        <div class="stat-card" style="border-color: var(--danger);">
            <div class="stat-value" style="color: var(--danger);">0</div>
            <div class="stat-label">Absent</div>
        </div>
        <div class="stat-card" style="border-color: var(--warning);">
            <div class="stat-value" style="color: var(--warning);">0</div>
            <div class="stat-label">Late</div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-top: 0;">Recent Records</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--border); text-align: left;">
                    <th style="padding: 1rem 0.5rem;">Date</th>
                    <th style="padding: 1rem 0.5rem;">Class</th>
                    <th style="padding: 1rem 0.5rem;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="padding: 2rem; text-align: center; color: var(--text-muted);">
                        No attendance records found yet.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
