@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <h1 class="card-title">Create New Class</h1>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.classes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Class / Section Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. BSIT 1A">
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">Create Class</button>
                <a href="{{ route('admin.classes.index') }}" class="btn" style="background-color: #e2e8f0; color: #475569; text-align: center; flex: 1;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
