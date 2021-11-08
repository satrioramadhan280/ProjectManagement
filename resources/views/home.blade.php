@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<h1>Hello, {{Auth::user()->name}}</h1>
@can('Admin')
  <a href="{{url('/admin/index')}}">{{$totalUsers}}</a>

@endcan

@can('isHDiv')
ini HDiv
@endcan

@can('isHDept1')
ini HDept1
@endcan

@endsection