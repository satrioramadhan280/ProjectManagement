@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<h1>Hello, {{Auth::user()->name}}</h1>
@can('Admin')
<div class="d-inline">
  <a href="{{url('/admin/add')}}" class="btn btn-primary">Add Employee</a>
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
      <td>{{$user->id-1}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->roles->name}}</td>
      <td><a href="/admin/{{$user->id}}">Detail</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$users->links()}}
@endcan

@can('isHDiv')
ini HDiv
@endcan

@can('isHDept1')
ini HDept1
@endcan

@endsection