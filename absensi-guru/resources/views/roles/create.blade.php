@extends('layouts.app')

@section('title', 'Create Role')

@section('content')

<h2 class="mb-4 fw-bold">Create Role</h2>

<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Create</button>
</form>

@endsection
