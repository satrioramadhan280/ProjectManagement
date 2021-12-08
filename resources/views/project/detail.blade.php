@extends('layouts.app')

@section('title')
{{$project->title}}
@endsection

@section('content')
<h1>{{ $project->title }}</h1>
<a href="{{ route('add_task_view', [$project->id]) }}" class="btn btn-primary">Add  Task</a>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Member
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Member to Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/projects/addMember/{{$project->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($users as $user)
                <div class="form-check d-block">
                    <input class="form-check-input" type="checkbox" value="{{$user->id}}" id="flexCheckDefault" name="user_id">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$user->firstName}} {{$user->lastName}}
                    </label>
                </div>
                @endforeach
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

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
    <h4>There are no tasks available</h4>
@endif


<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
})

</script>
@endsection
