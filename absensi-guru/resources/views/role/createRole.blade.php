@extends('layouts.app')

@section('title', 'Create Role')

@section('content')

<h2 class="mb-4 fw-bold">Create Role</h2>

<form action="{{ route('role.storeRole') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="role_name" class="form-label">Role Name</label>
        <input type="text" class="form-control" id="role_name" name="role_name" required>
        @error('role_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Role</button>
</form>

@endsection
