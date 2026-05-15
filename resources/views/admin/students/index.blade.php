@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 class="card-title" style="margin: 0;">Manage Students</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">+ Add New Student</a>
    </div>

    @if(session('success'))
        <div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f1f5f9; text-align: left;">
                    <th style="padding: 1rem;">Name</th>
                    <th style="padding: 1rem;">Email</th>
                    <th style="padding: 1rem;">Registered Date</th>
                    <th style="padding: 1rem; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 1rem; font-weight: 500;">{{ $student->name }}</td>
                        <td style="padding: 1rem; color: var(--text-muted);">{{ $student->email }}</td>
                        <td style="padding: 1rem; color: var(--text-muted);">{{ $student->created_at->format('M d, Y') }}</td>
                        <td style="padding: 1rem; text-align: right;">
                            <a href="{{ route('admin.students.edit', $student) }}" style="color: var(--primary); text-decoration: none; font-weight: 600; margin-right: 1rem;">Edit</a>
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: var(--danger); font-weight: 600; cursor: pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                            No students found. Click "Add New Student" to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
