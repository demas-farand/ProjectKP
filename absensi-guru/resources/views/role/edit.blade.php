@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<h2 class="mb-4 fw-bold">Edit Role</h2>

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="role_name" class="form-label">Role Name</label>
        <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Role</button>
</form>

@endsection