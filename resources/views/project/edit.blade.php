@extends('layouts.app')

@section('title')
Edit Project
@endsection

@section('content')
<h4>Edit Project</h4>

<form action="{{route('edit_project', [$project->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-3">
      <label for="projectTitle" class="form-label">Project Title</label>
      <input type="text" class="form-control" name="projectTitle" value="{{ $project->title }}">
    </div>
    <div class="mb-3">
        <label for="startDate" class="form-label">Start Date</label>
        <input class="form-control" type="date" name="startDate" value="{{ $project->startDate }}">
    </div>
    <div class="mb-3">
        <label for="endDate" class="form-label">End Date</label>
        <input class="form-control" type="date" name="endDate" value="{{ $project->endDate }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
