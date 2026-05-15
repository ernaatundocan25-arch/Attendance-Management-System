@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <h1 class="card-title">Edit Class & Assign Students</h1>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.classes.update', $class) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom: 2rem;">
                <label class="form-label">Class Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $class->name) }}" required>
            </div>

            <div class="card" style="background-color: #f8fafc; border-style: dashed;">
                <h3 style="margin-top: 0;">Assign Students to this Class</h3>
                <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1.5rem;">Select students to include in this section.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; max-height: 400px; overflow-y: auto; padding: 0.5rem;">
                    @forelse($students as $student)
                        <label style="display: flex; align-items: center; gap: 0.5rem; background: white; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border); cursor: pointer;">
                            <input type="checkbox" name="students[]" value="{{ $student->id }}" 
                                {{ in_array($student->id, $assignedStudents) ? 'checked' : '' }}
                                style="width: 1.25rem; height: 1.25rem;">
                            <span style="font-size: 0.875rem;">{{ $student->name }}</span>
                        </label>
                    @empty
                        <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 1rem;">No students registered yet.</p>
                    @endforelse
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">Update Class & Assignments</button>
                <a href="{{ route('admin.classes.index') }}" class="btn" style="background-color: #e2e8f0; color: #475569; text-align: center; flex: 1;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
