@extends('layouts.app')

@section('title')
Projects
@endsection

@section('content')
<h1>Hello, {{Auth::user()->firstName}} {{Auth::user()->lastName}}</h1>
<a href="{{url('/projects/add')}}" class="btn btn-primary">Add  Project</a>

@if(!$projects->isEmpty())
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Project Status</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{$project->projectTitle}}</td>
            <td>{{$project->projectStatus}}</td>
            <td><a href="#">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h4>There are no projects available</h4>
@endif

@endsection
