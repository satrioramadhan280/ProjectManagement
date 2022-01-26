<script src="https://unpkg.com/feather-icons"></script>
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

    .task-record:hover{
        background-color: rgba(95, 95, 95, 0.301);
    }

    .active, .task-record:hover{

    }


    .forum-record{
        cursor: pointer;

    }

    .active, .forum-record:hover{
        color: blue;
    }

    .reply{
        cursor: pointer;

    }

    .active, .reply:hover{
        color: blue;
    }



    .reply-content {

        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #ffffff;
    }

    .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #ffffff;
    }

    .forum-content {

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

    .forum-box {
        box-shadow: 0 4px 8px 0 rgba(172, 167, 167, 0.363), 2px 6px 20px 0 rgba(180, 173, 173, 0.068);
        text-align: center;
    }

</style>


@extends('layouts.app')

@section('title')
{{$project->title}}
@endsection

@section('content')

@if (session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif

@if (session('addMember'))
    <div class="alert alert-success mt-3">
        {{ session('addMember') }}
    </div>
@endif

@if (session('create'))
    <div class="alert alert-success mt-3">
        {{ session('create') }}
    </div>
@endif

@if (session('update'))
    <div class="alert alert-success mt-3">
        {{ session('update') }}
    </div>
@endif

@if (session('post_success'))
    <div class="alert alert-success mt-3">
        {{ session('post_success') }}
    </div>
@endif

@if (session('post_delete'))
    <div class="alert alert-danger mt-3">
        {{ session('post_delete') }}
    </div>
@endif

@if (session('post_reply'))
    <div class="alert alert-success mt-3">
        {{ session('post_reply') }}
    </div>
@endif

<div class="d-flex flex-row">
    <h4 class="mt-1">{{ $project->title }}</h4>
    @if (Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
    Auth::user()->roleID == 6)
        <form class="ml-3" action="/deleteProject/{{$project->id}}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure want to delete this project?')"><span data-feather="trash-2"></span> Delete Project</button>
        </form>    
    @endif  
</div>
<hr>
    @if ($project->users()->where('user_id', Auth::user()->id)->first() || Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
    Auth::user()->roleID == 6)
    
    <div class="mt-4 mb-4 d-inline">
        {{-- <a href="{{ route('add_task_view', [$project->id]) }}" class="btn btn-primary"><span data-feather="clipboard"></span> Add  Task</a> --}}
        <div class="d-flex flex-row">
            <div class="btn-group mr-3">
                <button class="btn btn-primary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                  {{ $project->status->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                    @foreach ($statuses as $status)
                        <li><a class="dropdown-item" href="{{ route('change_project_status', [$project->id, $status->id]) }}">{{ $status->name }}</a></li>
                    @endforeach
                </ul>
            </div>

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
            <a href="{{ route('edit_project_view', [$project->id]) }}" class="btn btn-primary ml-3 mr-3"> Edit Project</a>
           
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal" onclick="closeDialog()">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
               

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Task Name <label style="font-size: 13px">(*required)</label></label>
                        <input type="text" class="form-control @error('taskName') is-invalid @enderror" name="taskName" value="{{ old('taskName') }}" required>
                        @error('taskName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="descrption" class="form-label mt-3">Description <label style="font-size: 13px">(*required)</label></label>
                        <textarea class="form-control @error('taskDescription') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="taskDescription" required></textarea>
                        @error('taskDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal" onclick="closeDialog()">Close</button>
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
                            <td class="p-3"><p>{{$task->name}}</p></td>
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
                            @if ($task->users()->where('user_id', Auth::user()->id)->first())       
                            <div class="d-flex flex-column">
                                
                                {{-- @if (Auth::user()->projects->id == $project->id) --}}
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
                                {{-- @endif --}}
                            </div>
                            @endif
                        </div>
                    </div>


                    @endforeach
                    @else
                        <h4 class="m-4">There are no tasks available</h4>
                    @endif

                @elseif ($user_tabs=='files')

                    <div class="m-4">
                        <h3>Files</h3>
                        @if ($project->users()->where('user_id', Auth::user()->id)->first() || Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
                        Auth::user()->roleID == 6)
                            <button id="fileUploadButton" type="button" class="btn btn-primary btn-sm">Upload</button>
                        @endif

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
                                                @if ($project->users()->where('user_id', Auth::user()->id)->first() || Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
                                                Auth::user()->roleID == 6)
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
                                                @endif
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

                        <div class="m-3 ">
                            @if ($project->users()->where('user_id', Auth::user()->id)->first() || Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
                            Auth::user()->roleID == 6)
                            <div class="p-3 forum-box rounded">
                                <div class="d-flex flex-column p-2">
                                    <div class="d-flex justify-content-between border-bottom">
                                        <div class="d-flex flex-row mb-2">
                                            <div><img class="rounded-circle border border-3 d-inline ml-2" src="{{asset("uploads/users_photo/".$users[Auth::user()->id-1]->photo)}}" height="45px" width="45px" alt=""></div>
                                            <div class=" align-items-center d-flex ml-3 mb-3">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex justify-content-start "><span class="font-weight-bold" style="font-size: 20px">{{Auth::user()->name}}</span></div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="" style="font-size: 13px"></div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <form  method="POST" action="/projects/detail/{{$project->id}}/forum">
                                            @csrf

                                            <div class="d-flex justify-content-start">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Post a comment"></textarea>

                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <input class="btn-sm btn-primary pl-3 pr-3" type="submit" value="Post" name="post">
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                {{-- Button forum reply --}}


                            </div>
                            @endif

                        </div>

                        @foreach ($forums as $forum)
                            <div class="m-3 ">
                                <div class="p-3 forum-box rounded">
                                    <div class="d-flex flex-column p-2">
                                        <div class="d-flex justify-content-between border-bottom">
                                            <div class="d-flex flex-row">
                                                <div><img class="rounded-circle border border-3 d-inline ml-2" src="{{asset("uploads/users_photo/".$users[$forum->user_id-1]->photo)}}" height="45px" width="45px" alt=""></div>
                                                <div class=" align-items-center d-flex ml-3 mb-3">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex justify-content-start align-items-center"><span class="font-weight-bold" style="font-size: 20px">{{$users[$forum->user_id-1]->name}}</span> @if ($users[$forum->user_id-1]->id == Auth::user()->id)
                                                            <a href="/projects/detail/{{$project->id}}/forum/delete/{{$forum->id}}" style="color: rgb(179, 0, 0)"><span data-feather="trash-2" class="ml-2"></span></a>
                                                        @endif</div>
                                                        <div class="d-flex align-items-center "><span style="font-size: 13px; color: rgb(78, 78, 78)" class="">{{$forum->created_at->format('H:i:s')}}</span></div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex flex-column ">
                                                <div class="" style="font-size: 13px">{{$forum->created_at->format('d/m/Y')}}</div>

                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-start">
                                                <p>{{$forum->description}}</p>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Button forum reply --}}
                                    <div class="d-flex flex-row justify-content-end" style="font-size: 13px">
                                        <div class="m-2 forum-record"
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($forums_reply as $forum_reply)
                                            @if ($forum_reply->forum_id == $forum->id)
                                            @php
                                                $count = $count + 1
                                            @endphp
                                            @endif
                                        @endforeach
                                        @if ($count == 0)
                                            hidden
                                        @endif
                                            >

                                            <span class="">Show Replies</span></div>
                                            @if ($project->users()->where('user_id', Auth::user()->id)->first() || Auth::user()->roleID == 2 || Auth::user()->roleID == 3 || Auth::user()->roleID == 4 || Auth::user()->roleID == 5 ||
                                            Auth::user()->roleID == 6)
                                                <div class="m-2 reply" ><span>Reply</span></div>
                                            @endif
                                    </div>
                                    <div class="reply-content mt-4 border-top">
                                        <div class="d-flex justify-content-start mt-3">
                                            <span class="">Comments</span>
                                        </div>
                                        <form class=" flex-row justify-content-between mt-2" method="POST" action="/projects/detail/{{$project->id}}/forum/{{$forum->id}}/reply">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <input class="btn-sm btn-primary pl-3 pr-3" type="submit" value="Post" name="post">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="m-3 forum-content">
                                @foreach ($forums_reply as $forum_reply)

                                    @if ($forum_reply->forum_id == $forum->id)
                                        <div class="p-3 forum-box ml-5 mr-1 mt-1 mb-1">
                                            <div class="d-flex flex-column p-2">
                                                <div class="d-flex justify-content-between border-bottom">
                                                    <div class="d-flex flex-row">
                                                        <div><img class="rounded-circle border border-3 d-inline ml-2" src="{{asset("uploads/users_photo/".$users[$forum_reply->user_id-1]->photo)}}" height="30px" width="30px" alt=""></div>
                                                        <div class=" align-items-center d-flex ml-3 mb-3">
                                                            <div class="d-flex flex-column">
                                                                <div class="d-flex justify-content-start"><span class="font-weight-bold" style="font-size: 15px">{{$users[$forum_reply->user_id-1]->name}}  @if ($users[$forum_reply->user_id-1]->id == Auth::user()->id)
                                                                    <a href="/projects/detail/{{$project->id}}/forum_reply/delete/{{$forum_reply->id}}" style="color: rgb(179, 0, 0)"><span data-feather="trash-2" class="ml-1"></span></a>
                                                                @endif</span></div>
                                                                <div class="d-flex align-items-center "><span style="font-size: 12px; color: rgb(78, 78, 78)" class="">{{$forum_reply->updated_at->format('H:i:s')}}</span></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="" style="font-size: 13px">{{$forum_reply->updated_at->format('d/m/Y')}}</div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="d-flex justify-content-start" style="font-size: 14px">
                                                        <p>{{$forum_reply->description}}</p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                @endforeach

                            </div>

                        @endforeach

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
@if (count($errors) > 0)
    <script type="text/javascript">
        $(document).ready(function() {
             $('#exampleModal1').modal('show');
        });
    </script>
@endif
<script>


    $('.delete-file').on('click', function (e) {
        e.preventDefault() // Don't post the form, unless confirmed
        console.log('test');
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit(); // Post the surrounding form
        }
    });

    $('.task-record').ready(function () {
        var coll = document.getElementsByClassName("task-record");

        var i;

        for (i = 0; i < coll.length; i++) {

            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");

                // var content = this.nextElementSibling;
                var currentElement = this;

                while (currentElement) {
                    if (currentElement.className == "content border") {

                        break;
                    }
                    currentElement = currentElement.nextElementSibling;
                }
                var content = currentElement;
                console.log(content);
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }

    });

    $('.forum-record').ready(function () {
        var coll = document.getElementsByClassName("forum-record");

        var i;

        for (i = 0; i < coll.length; i++) {

            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");

                // var content = this.nextElementSibling;
                var currentElement = this.parentNode.parentNode.parentNode;

                while (currentElement) {
                    if (currentElement.className === "m-3 forum-content") {
                        // console.log(currentElement);
                        break;
                    }
                    currentElement = currentElement.nextElementSibling;
                }
                var content = currentElement;
                // console.log(content);
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }

    });


    $('.reply').ready(function () {
        var coll = document.getElementsByClassName("reply");

        var i;

        for (i = 0; i < coll.length; i++) {

            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");

                // var content = this.nextElementSibling;
                var currentElement = this.parentNode;
                console.log(currentElement);
                while (currentElement) {
                    if (currentElement.className === "reply-content mt-4 border-top") {
                        // console.log(currentElement);
                        break;
                    }
                    currentElement = currentElement.nextElementSibling;
                }
                var content = currentElement;
                // console.log(content);
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }

    });

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })

    
    function closeDialog() {
        $('#exampleModal1').modal('hide');
    }

</script>
@endsection

