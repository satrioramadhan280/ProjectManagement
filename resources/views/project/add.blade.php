@extends('layouts.app')

@section('title')
Add Project
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('add_project')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="projectTitle" class="form-label">Project Title</label>
      <input type="text" class="form-control" name="projectTitle" value="{{ old('projectTitle') }}">
    </div>
    <div class="mb-3">
        <label for="projectSR" class="form-label">Project SR</label>
        <input class="form-control" type="file" name="projectSR">
    </div>
    <div class="mb-3">
        <label for="endDate" class="form-label">Deadline</label>
        <input class="form-control" type="date" name="endDate">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
