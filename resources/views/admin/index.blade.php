@extends('layouts.app')

@section('title')
User Management
@endsection

@section('content')
<h1>User Management</h1>
<div class="d-inline">
    <a href="{{url('/admin/create')}}" class="btn btn-primary">Add Employee</a>
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
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$id++}}</td>
            <td>{{$user->firstName}} {{$user->lastName}}</td>
            <td>{{$user->roles->display}}</td>
            <td><a class="btn btn-primary" href="/user/{{$user->username}}/about">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}
@endsection