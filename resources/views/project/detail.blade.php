@extends('layouts.app')

@section('title')
{{$project->title}}
@endsection

@section('content')
<h1>{{ $project->title }}</h1>

@if (Auth::user()->role!="user")
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="mt-4 mb-4">
        {{-- <a href="{{ route('add_task_view', [$project->id]) }}" class="btn btn-primary"><span data-feather="clipboard"></span> Add  Task</a> --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
            Add Task
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            <span data-feather="user-plus"></span> Add Member
        </button>
    </div>

    <!-- Modal 1 -->
    <div class="modal fade"   id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <form action="{{ route('add_task', [$project->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
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
                        <label for="taskName" class="form-label">Task Name</label>
                        <input type="text" class="form-control" name="taskName" value="{{ old('taskName') }}">
                        <label for="descrption" class="form-label mt-3">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        <label for="taskMember" class="form-label mt-3">Assign Task Member</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($task_members as $task_member)
                            <div class="form-check d-block" style="width: 200px">
                                <input class="form-check-input" type="checkbox" value="{{$users[$task_member->user_id-1]->id}}" id="flexCheckDefault" name="users[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$users[$task_member->user_id-1]->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Member to Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/projects/addMember/{{$project->id}}" method="POST" enctype="multipart/form-data" >
                <div class="modal-body ml-3">

                    <div class="d-flex flex-wrap">
                        @csrf
                        @foreach ($users_department as $user)
                        <div class="form-check d-block ml-2 mr-2" style="width: 200px">
                            <input class="form-check-input" type="checkbox" value="{{$user->id}}" id="flexCheckDefault" name="users[]" @foreach ($project_members as $project_member)
                                @if ($user->id == $project_member->user_id)
                                    checked
                                @endif
                            @endforeach>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$user->name}}
                            </label>
                        </div>
                        @endforeach
                    </div>


                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endif


<div class="border rounded-top mt-3 d-flex justify-content-start flex-column">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link @if ($user_tabs=='tasks') text-dark and Active  @endif" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}" style="color: rgba(0, 0, 0, 0.466)">Tasks</a>
        </li>
        @cannot('Admin')
        <li class="nav-item" onclick="">
            <a class="nav-link @if ($user_tabs=='projects') text-dark and Active @endif" href="{{ route('project_detail_view', [$project->id, 'files']) }}" style="color: rgba(0, 0, 0, 0.466)">Files</a>
        </li>
        @endcannot

    </ul>
    <div class="ms-5 mt-4 mb-4">
        @if ($user_tabs=='tasks')
            {{-- Isi dari Tasks --}}
            @if(!$tasks->isEmpty())
                <table class="table mt-4">
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
                            <td><a href="/projects/detail/{{$project->id}}/{{$task->id}}">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4>There are no tasks available</h4>
            @endif

        @elseif ($user_tabs=='files')
            <h3>Files</h3>
            <button id="fileUploadButton" type="button" class="btn btn-primary btn-sm">Upload</button>

            <form id="addFile" class="row g-2 m-2" style="display: none;" action="{{ route('add_file', [$project->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="m-2 col-auto">
                    <input class="form-control form-control-sm" name="fileInput" type="file">
                </div>
                <div class="m-2 col-auto">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>

            @if(!$files->isEmpty())
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Size</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td>{{ $file['filename'] }}</td>
                        <td>{{ $file['extension'] }}</td>
                        <td>{{ $file['size'] }}</td>
                        <td>
                            <div class='row'>
                                <div class="col-sm-auto">
                                    <form method="GET" action="{{ route('download_file') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type='hidden' name="filePath" value="{{ $file['path'] }}">
                                            <input type="submit" class="btn btn-sm btn-primary" value="Download">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-auto">
                                    <form method="POST" action="{{ route('delete_file', [$project->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <input type='hidden' name="filePath" value="{{ $file['path'] }}">
                                            <input type="submit" class="btn btn-sm btn-danger delete-file" value="Delete">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h4>There are no files available</h4>
            @endif
        @endif

    </div>

</div>

<script>
    $('.delete-file').on('click', function (e) {
        e.preventDefault() // Don't post the form, unless confirmed
        console.log('test');
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit(); // Post the surrounding form
        }
    });

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
</script>
@endsection
