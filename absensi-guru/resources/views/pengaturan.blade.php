@extends('layouts.app')

@section('title', 'Pengaturan')

<link rel="stylesheet" href="{{ asset('css/Pengaturan/style.css') }}">

@section('content')

<h2 class="mb-4 fw-bold">Pengaturan</h2>

<div class="bg-light-green p-4 rounded" style="width: 300px;">
    <h4>Roles</h4>
    <ul>
        @foreach($roles as $role)
            <li>
                {{ $role->name }}
                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('role.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('role.create') }}" class="btn btn-primary">Add User</a>
    <a href="{{ route('role.createRole') }}" class="btn btn-primary">Add New Role</a>
</div>

@endsection