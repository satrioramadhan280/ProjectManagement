<style>
    .task-record{
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .active, .task-record:hover{
        background-color: rgba(95, 95, 95, 0.301);
    }



    .content {

        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #ffffff;
    }

    .hide {
        display: none;
    }
    
    .add-task-btn:hover + .hide {
        display: block;
        color: red;
    }

    /* Tooltip for disable button */
    .tooltip-div {
        position: relative;
        display: inline-block;
        /* border-bottom: 1px dotted black; */
    }

    .tooltip-span {
        font-size: 13px;
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 120%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip-span::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }

    .tooltip-div:hover .tooltip-span {
        visibility: visible;
        cursor: pointer;
    }

</style>


@extends('layouts.app')

@section('title')
{{$project->title}}
@endsection



@section('content')

@if (session('addMember'))
    <div class="alert alert-success mt-3">
        {{ session('addMember') }}
    </div>
@endif

<h1>{{ $project->title }}</h1>

@if (Auth::user()->role!="user")

    <div class="mt-4 mb-4">
        {{-- <a href="{{ route('add_task_view', [$project->id]) }}" class="btn btn-primary"><span data-feather="clipboard"></span> Add  Task</a> --}}
        <div class="d-flex flex-row">

            <div class="@if ($project_members->isEmpty())
                tooltip-div
            @endif">
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal1" @if ($project_members->isEmpty())
                    disabled
                @endif>
                    Add Task
                </button>
                <span class="tooltip-span">Assign Member First!</span>
            </div>
              
            
            <button type="button" class="btn btn-primary ml-3" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                <span data-feather="user-plus"></span> Add / Remove Member
            </button>
        </div>
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
                        <label for="taskName" class="form-label">Task Name <label style="font-size: 13px">(*required)</label></label>
                        <input type="text" class="form-control" name="taskName" value="{{ old('taskName') }}" required> 
                        <label for="descrption" class="form-label mt-3">Description <label style="font-size: 13px">(*required)</label></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="taskDescription" required></textarea>
                        <label for="taskMember" class="form-label mt-3">Assign Task Member <label style="font-size: 13px">(*required at least 1)</label></label>
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
            <h5 class="modal-title" id="exampleModalLabel">Add / Remove Project Members</h5>
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


<div class="d-flex mt-3 justify-content-between">

    {{-- Section Tabs --}}
    <div  style="width: 100%">
        <div class="border rounded-top d-flex justify-content-start flex-column" >
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link @if ($user_tabs=='tasks') text-dark and Active  @endif" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}" style="color: rgba(0, 0, 0, 0.466)">Tasks</a>
                </li>
                @cannot('Admin')
                <li class="nav-item" onclick="">
                    <a class="nav-link @if ($user_tabs=='files') text-dark and Active @endif" href="{{ route('project_detail_view', [$project->id, 'files']) }}" style="color: rgba(0, 0, 0, 0.466)">Files</a>
                </li>
                <li class="nav-item" onclick="">
                    <a class="nav-link @if ($user_tabs=='forum') text-dark and Active @endif" href="{{ route('project_detail_view', [$project->id, 'forum']) }}" style="color: rgba(0, 0, 0, 0.466)">Forum</a>
                </li>
                @endcannot

            </ul>
            <div class="mt-3">
                @if ($user_tabs=='tasks')
                    {{-- Isi dari Tasks --}}
                    @if(!$tasks->isEmpty())
                    @foreach ($tasks as $task)
                    <div class="task-record border-bottom">
                        {{-- <td>1.</td> --}}
                        <div class="d-flex flex-row justify-content-between">
                            <td class="p-3"><h5>{{$task->name}}</h5></td>
                            <div class="d-flex flex-row">
                                @if ($task->status == 'Ongoing')
                                    <span>{{$task->status}}</span>
                                    <img class="ml-1" src="{{asset("img/icons/ongoing.png")}}" height="20px" width="20px" alt="">

                                @elseif ($task->status == 'Completed')
                                    <span>{{$task->status}}</span>
                                    <img class="ml-1" src="{{asset("img/icons/completed.png")}}" height="20px" width="20px" alt="">
                                @endif
                            </div>
                        </div>

                        {{-- <td><a href="/projects/detail/{{$project->id}}/{{$task->id}}">Detail</a></td> --}}
                    </div>
                    <div class="content border">
                        <div class="m-4 d-flex justify-content-between">
                            <div style="width: 700px">
                                <p style="font-size: 20px">{{$task->description}}</p>
                                <div class="d-flex flex-column" style="font-size: 15px">

                                    <span>Handled by : @foreach ($task_user as $user)
                                        @if ($user->task_id == $task->id)
                                            <a href="">
                                                <div class="tooltip-div">
                                                    <img class="rounded-circle border border-3 d-inline ml-2" src="{{asset("uploads/users_photo/".$users[$user->user_id-1]->photo)}}" height="24px" width="24px" alt="">
                                                    <span class="tooltip-span">{{$users[$user->user_id-1]->name}}</span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <form action="/projects/detail/{{$project->id}}/{{$task->id}}/change_task_status" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" style="color: white">Change Status</button>
                                    </form>
                                </div>
                                <form action="/projects/detail/{{$project->id}}/{{$task->id}}/remove" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove Task</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    @endforeach
                    @else
                        <h4 class="m-4">There are no tasks available</h4>
                    @endif

                @elseif ($user_tabs=='files')
                
                    <div class="m-4">
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
                    </div>

                @elseif ($user_tabs=='forum')
                    <div class="m-4">
                        <h3>Files</h3>
                        @if(!$files->isEmpty())
    
                        @else
                            <h4>There are no files available</h4>
                        @endif
                    </div>

                @endif

            </div>
        </div>
    </div>


    {{-- Section Members --}}
    <div class="d-flex ml-5"  >
            <div>
                <div class="border rounded-top d-flex justify-content-start flex-column p-3"  style="width: 100%">
                    <h5 class="text-center">Project Members</h5>
                    <div class="mt-3">
                        @if ($project_members->isEmpty())
                            <span class="text-center">No member has been assigned yet.</span>
                        @else
                            @foreach ($project_members as $project_member)
                                <div class="d-flex flex-row m-2 ">
                                    <div><img class="rounded-circle border border-3 d-inline" src="{{asset("uploads/users_photo/".$users[$project_member->user_id-1]->photo)}}" height="30px" width="30px" alt=""></div>
                                    <div class="ml-2">{{$users[$project_member->user_id-1]->name}}</div>
                                </div>

                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

    </div>
</div>








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

var coll = document.getElementsByClassName("task-record");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
</script>
@endsection

