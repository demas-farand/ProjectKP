@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<h2 class="mb-4 fw-bold">Edit User</h2>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password (leave blank to keep current password)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                    {{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

@endsection