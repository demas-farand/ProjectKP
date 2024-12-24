@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<h2 class="mb-4 fw-bold">Edit Role</h2>

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

@endsection