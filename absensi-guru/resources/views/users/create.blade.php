@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<h2 class="mb-4 fw-bold">Create User</h2>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Create</button>
</form>

@endsection