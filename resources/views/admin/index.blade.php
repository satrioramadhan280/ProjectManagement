@extends('layouts.app')

@section('title')
User Management
@endsection

@section('content')
<h1>User Management</h1>
<div class="d-inline">
    <a href="{{url('/admin/create')}}" class="btn btn-primary">Add Employee</a>
</div>
<table class="table">
    <thead>
        <tr>
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
            <td><a href="/{{$user->username}}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}
@endsection