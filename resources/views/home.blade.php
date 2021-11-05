@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<h1>Welcome, {{Auth::user()->name}}</h1>
{{$total_users}}
@can('isAdmin')
 ini admin    
@endcan
@can('isHDiv')
 ini HDiv    
@endcan
@can('isHDept1')
 ini HDept1    
@endcan
test online
@endsection