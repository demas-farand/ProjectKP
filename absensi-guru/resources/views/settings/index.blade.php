@extends('layouts.app')

@section('title', 'Pengaturan')

<link rel="stylesheet" href="{{ asset('css/Pengaturan/style.css') }}">

@section('content')

<h2 class="mb-4 fw-bold">Pengaturan</h2>

<div class="bg-light-green p-4 rounded">

    <h4>Roles</h4>
    <ul>
        @foreach($roles as $role)
            <li>{{ $role->name }}
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('roles.create') }}" class="btn btn-success mt-3">Add New Role</a>

    <h4 class="mt-5">Users</h4>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ $user->roles->pluck('name')->join(', ') }}
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('users.create') }}" class="btn btn-success mt-3">Add New User</a>

</div>

@endsection