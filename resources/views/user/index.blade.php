@extends('layouts.app')

@can('HDept1')@section('title')Department 1 @endsection @endcan
@can('HDept2')@section('title')Department 2 @endsection @endcan
@can('HDept3')@section('title')Department 3 @endsection @endcan
@can('HDept4')@section('title')Department 4 @endsection @endcan

@section('content')

@can('isHDiv')
ini HDiv
@endcan

@can('HDept1')<h1 class="m-3">Department 1 List</h1>@endcan
@can('HDept2')<h1 class="m-3">Department 2 List</h1>@endcan
@can('HDept3')<h1 class="m-3">Department 3 List</h1>@endcan
@can('HDept4')<h1 class="m-3">Department 4 List</h1>@endcan

<table class="table">
  <thead class="bg-danger">
    <tr>
      <th class="text-white" scope="col">No</th>
      <th class="text-white" scope="col">Name</th>
      <th class="text-white" scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    @can('HDept1')
    @foreach ($dept1 as $dept)
    <tr>
      <td>{{$key++}}</td>
      <td>{{$dept->name}}</td>
      <td><a href="/{{$dept->username}}">Detail</a></td>
    </tr>
    @endforeach
  </tbody>

  {{$dept1->links()}}
  @endcan

  @can('HDept2')
  @foreach ($dept2 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->name}}</td>
    <td><a href="/{{$dept->username}}">Detail</a></td>
  </tr>
  @endforeach
  </tbody>
  {{$dept2->links()}}
  @endcan

  @can('HDept3')
  @foreach ($dept3 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->name}}</td>
    <td><a href="/{{$dept->username}}">Detail</a></td>
  </tr>
  @endforeach
  {{$dept3->links()}}
  @endcan
  </tbody>
  @can('HDept4')
  @foreach ($dept4 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->name}}</td>
    <td><a href="/{{$dept->username}}">Detail</a></td>
  </tr>
  @endforeach
  </tbody>
  {{$dept4->links()}}
  @endcan
</table>

@endsection