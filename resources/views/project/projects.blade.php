@extends('layouts.app')

@section('title')
Projects
@endsection

@section('content')
<h1>Hello, {{Auth::user()->firstName}} {{Auth::user()->lastName}}</h1>
<a data-href="{{ route('add_project_view') }}"
    class="btn btn-primary" 
    id="createProjectbtn"
    >
    Add  Project
</a>


@if(!$projects->isEmpty())
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Project Status</th>
            <th scope="col">Deadline</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->status}}</td>
            <td>{{$project->endDate}}</td>
            <td><a href="{{ route('project_detail_view', [$project->id]) }}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h4>There are no projects available</h4>
@endif


<!-- Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
  

@endsection
