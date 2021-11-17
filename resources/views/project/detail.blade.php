@extends('layouts.app')

@section('title')
Detail
@endsection

@section('content')
<h1>{{ $project->title }}</h1>
<a href="{{ route('add_task_view', [$project->id]) }}" class="btn btn-primary">Add  Task</a>

@if(!$tasks->isEmpty())
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td>{{$task->name}}</td>
            <td><a href="#">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h4>There are no projects available</h4>
@endif


@endsection
