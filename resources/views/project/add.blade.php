@extends('layouts.app')

@section('title')
Add Project
@endsection

@section('content')

<form action="{{route('add_project')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="projectTitle" class="form-label">Project Title</label>
      <input type="text" class="form-control" name="projectTitle">
    </div>
    <div class="mb-3">
        <label for="projectSR" class="form-label">Project SR</label>
        <input class="form-control" type="file" name="projectSR">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
