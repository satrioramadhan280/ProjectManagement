<style>

  .normal-text{
    text-decoration: none;
    color: black;
  }

  .hover_image:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
  }
</style>

@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="d-flex justify-content-center">
  <h1>Hello, {{Auth::user()->firstName}} {{Auth::user()->lastName}}</h1>
</div>

{{-- @can('Admin') --}}
  <div class="d-flex justify-content-center flex-column mt-3">
    <div class="d-flex justify-content-center mt-5" >
      <div class="d-flex flex-row justify-content-around" style="width: 1000px">
        <div class="hover_image d-flex flex-column justify-content-center">
          @can('Admin')
          <a href="{{URL('/admin/index')}}" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">{{$TotalUsers}} Users</h3>
          </a>
          @endcan
          @can('HDept1')
          <a href="{{URL('/user/index')}}" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">{{$TotalDept1}} Users</h3>
          </a>
          @endcan
          @can('HDept2')
          <a href="{{URL('/user/index')}}" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">{{$TotalDept2}} Users</h3>
          </a>
          @endcan
          @can('HDept3')
          <a href="{{URL('/user/index')}}" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">{{$TotalDept3}} Users</h3>
          </a>
          @endcan
          @can('HDept4')
          <a href="{{URL('/user/index')}}" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">{{$TotalDept4}} Users</h3>
          </a>
          @endcan
        </div>

        @can('Admin')
        <div class="hover_image d-flex flex-column justify-content-center">
          <a href="" class="normal-text" style="color: black">
            <img src="{{URL::asset('/img/department-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
            {{-- <a href="{{url('/admin/index')}}" class="text-center">Users</a> --}}
            <h3 class="text-center mb-3">Department</h3>
          </a>
        </div>
        @endcan
      </div>
    </div>
  </div>
{{-- @endcan --}}

@can('isHDiv')
ini HDiv
@endcan

{{-- @can('HDept1')
<div class="d-flex justify-content-center mt-5" >
  <div class="d-flex flex-row justify-content-around" style="width: 1000px">
    <div class="hover_image d-flex flex-column justify-content-center">
      <a href="/admin/index" class="normal-text" style="color: black">
        <h2 class="text-center">Department 1</h2>
        <img src="{{URL::asset('/img/user-icon.png')}}" class="m-3" alt="" style="height: 200px; width: 200px">
        <a href="{{url('/admin/index')}}" class="text-center">Users</a>
        <h3 class="text-center mb-3">{{$TotalDept1}} Users</h3>
      </a>
    </div>
  </div>
@endcan --}}

@endsection