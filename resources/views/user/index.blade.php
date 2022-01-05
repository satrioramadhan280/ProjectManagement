@extends('layouts.app')

@can('HDept1')@section('title')IT Customer Relationship Management @endsection @endcan
@can('HDept2')@section('title')IT Branch Delivery System @endsection @endcan
@can('HDept3')@section('title')IT Micro and Retail Core Loan System @endsection @endcan
@can('HDept4')@section('title')IT Internal Application @endsection @endcan

@section('content')

@can('isHDiv')
ini HDiv
@endcan

@can('Admin')<h1 class="mb-3">Users List</h1>@endcan
@can('HDept1')<h1 class="mb-3">IT Customer Relationship Management List</h1>@endcan
@can('HDept2')<h1 class="mb-3">IT Branch Delivery System List</h1>@endcan
@can('HDept3')<h1 class="mb-3">IT Micro and Retail Core Loan System List</h1>@endcan
@can('HDept4')<h1 class="mb-3">IT Internal Application List</h1>@endcan

<table class="table">
  <thead class="bg-danger">
    <tr>
      <th class="text-white" scope="col">No</th>
      <th class="text-white" scope="col">Name</th>
    </tr>
  </thead>
  <tbody>
    @can('Admin')
      @foreach ($users as $user)
      <tr>
        <td>{{$id++}}</td>
        <td>{{$user->firstName}} {{$user->lastName}}</td>

      </tr>
      @endforeach
  </tbody>
  {{$users->links()}}
  @endcan
  @can('HDept1')
    @foreach ($dept1 as $dept)
    <tr>
      <td>{{$id++}}</td>
      <td>{{$dept->firstName}} {{$dept->lastName}}</td>

    </tr>
    @endforeach
  </tbody>
  {{$dept1->links()}}
  @endcan

  @can('HDept2')
  @foreach ($dept2 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->firstName}} {{$dept->lastName}}</td>
  </tr>
  @endforeach
  </tbody>
  {{$dept2->links()}}
  @endcan

  @can('HDept3')
  @foreach ($dept3 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->firstName}} {{$dept->lastName}}</td>
  </tr>
  @endforeach
  {{$dept3->links()}}
  @endcan
  </tbody>
  @can('HDept4')
  @foreach ($dept4 as $dept)
  <tr>
    <td>{{$key}}</td>
    <td>{{$dept->firstName}} {{$dept->lastName}}</td>
  </tr>
  @endforeach
  </tbody>
  {{$dept4->links()}}
  @endcan
</table>

@endsection