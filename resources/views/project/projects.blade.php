@extends('layouts.app')

@section('title')
Projects
@endsection

@section('content')
<h1>Hello, {{Auth::user()->name}}</h1>
<a href="{{url('/projects/add')}}">Add  Project</a>
@can('Admin')

@endcan

@can('isHDiv')
ini HDiv
@endcan

@can('isHDept1')
ini HDept1
@endcan

@endsection
