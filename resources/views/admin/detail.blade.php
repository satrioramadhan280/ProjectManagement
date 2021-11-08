@extends('layouts.app')

@section('title')
        {{$user->username}}
@endsection

@section('content')
    {{$user->name}}
    <img src="{{asset('img/').$user->photo}}" height="200px" width="200px" alt="">
@endsection
