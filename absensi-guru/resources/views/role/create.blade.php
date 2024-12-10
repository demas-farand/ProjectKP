@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<h2 class="mb-4 fw-bold">Create User</h2>

<form action="{{ route('role.storeUser') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dropdown untuk Role -->
    <div class="mb-3">
        <label for="role_id" class="form-label">Role</label>
        <select class="form-control" id="role_id" name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role_id')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create User</button>
</form>

@endsection