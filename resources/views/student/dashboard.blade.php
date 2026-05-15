@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">My Attendance Dashboard</h1>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Welcome, {{ Auth::user()->name }}. Here is your attendance overview.</p>

    <div class="stats-grid">
        <div class="stat-card" style="border-bottom: 4px solid var(--success);">
            <div class="stat-value" style="color: var(--success);">{{ $stats['present'] }}</div>
            <div class="stat-label">Present</div>
        </div>
        <div class="stat-card" style="border-bottom: 4px solid var(--danger);">
            <div class="stat-value" style="color: var(--danger);">{{ $stats['absent'] }}</div>
            <div class="stat-label">Absent</div>
        </div>
        <div class="stat-card" style="border-bottom: 4px solid var(--warning);">
            <div class="stat-value" style="color: var(--warning);">{{ $stats['late'] }}</div>
            <div class="stat-label">Late</div>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--border);">
            <h3 style="margin: 0;">My Attendance History</h3>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f1f5f9; text-align: left;">
                    <th style="padding: 1rem;">Date</th>
                    <th style="padding: 1rem;">Class</th>
                    <th style="padding: 1rem;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 1rem; font-weight: 500;">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</td>
                        <td style="padding: 1rem; color: var(--text-muted);">{{ $attendance->schoolClass->name }}</td>
                        <td style="padding: 1rem;">
                            @if($attendance->status == 'present')
                                <span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Present</span>
                            @elseif($attendance->status == 'absent')
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Absent</span>
                            @else
                                <span style="background-color: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Late</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                            No attendance records found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
