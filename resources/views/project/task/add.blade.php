@extends('layouts.app')

@section('title')
Add Task
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

<form action="{{ route('add_task', [$project->id]) }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="taskName" class="form-label">Task Name</label>
      <input type="text" class="form-control" name="taskName" value="{{ old('taskName') }}">
      <label for="taskName" class="form-label mt-2">Desciption</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
