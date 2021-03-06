@extends('layouts.app')

@section('title')
User Management
@endsection

@section('content')
<h1>User Management</h1>
<div class="d-inline">
    <a href="{{url('/admin/create')}}" class="btn btn-primary mb-3"><span data-feather="user-plus"></span> Add New User</a>
    <form class="d-flex" method="GET" action="/searchUser">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</div>
@if (session('create'))
    <div class="alert alert-success mt-3">
        {{ session('create') }}
    </div>
@endif
@if (session('delete'))
    <div class="alert alert-success mt-3">
        {{ session('delete') }}
    </div>
@endif
<table class="table mt-2">
    <thead>
        <tr class="bg-danger text-white">
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col" class="dropdown-toggle">Division</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="col-1">{{$id++}}</td>
            <td class="col-5">{{$user->name}}</td>
            <td class="col-5">{{$user->roles->display}}</td>
            <td><a class="btn btn-primary" href="/admin/{{$user->username}}/edit">Edit Profile</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $users->appends(\Request::except('page'))->render() !!}
@endsection