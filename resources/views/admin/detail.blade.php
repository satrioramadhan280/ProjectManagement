<style>
    .pp-pos {
        position: relative;
        left: 30px;
        bottom: 90px;
    }

    .hide {
        display: none;
    }

    .pp-changepic:hover+.hide {
        display: block;
        color: black;
        color: black;
        text-decoration: none;
    }

    .span-changepic {
        position: relative;
        left: 60px;
        bottom: 170px;
        text-decoration: none;
        opacity: 0.7;
        font-size: 12px;
    }

    .span-changepic:hover {
        display: block;
        color: black;
        text-decoration: none;
        opacity: 1.0;

    }

    .changepp-tittle {
        text-decoration: none;
        color: black;

    }

    .changepp-title:hover {
        color: black;
        text-decoration: none;
    }

    .title-border:hover {
        background-color: rgba(243, 243, 243, 0.658);
        cursor: pointer;
    }

    .user-info {
        position: relative;
        left: 250px;
    }
</style>

@extends('layouts.app')

@section('title')
{{$user->name}}
@endsection

@section('content')


{{-- {{$user->name}}
{{$user->email}} --}}
@if (session('password'))
<div class="alert alert-success mt-3">
    {{ session('password') }}
</div>
@endif
@if (session('update'))
<div class="alert alert-success mt-3">
    {{ session('update') }}
</div>
@endif


<div class="border rounded">
    <div class="d-flex bg-warning  bg-danger " style="height: 250px;">

    </div>

    <div class="pp-pos" style="height: 20px;">
        <img class="pp-changepic rounded-circle border border-3 " src="{{asset("uploads/users_photo/".$user->photo)}}"
        height="200px" width="200px" alt="">
        <div class="hide span-changepic" style="width: 110px;height: 32px;">
            <div class="title-border d-flex justify-content-center rounded-pill border border-dark"
                style="width: 110px;height: 32px;">
                @if (Auth::user()->id == $user->id)
                    <a data-toggle="modal" data-target="#exampleModalCenter" class="d-flex m-1 changepp-title" height="10px"
                    width="10px" style="text-decoration: none;color: black"><img src="{{asset("
                        img/icons/pencil.png")}}" alt="pencil-icon" height="13px" width="14px">Change Picture</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form method="POST" name="updatepp_field" action="/update/profile_picture/{{$user->id}}" class="ml-3"
        enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Profile Picture</h5>
                    </div>
                    <div class="modal-body justify-content-center d-flex mt-2">

                        <div class="form-group">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="photo">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="d-flex flex-column" style="height: 124px">
        <div class="d-flex ">
            <div class="d-flex user-info flex-column">
                <h1>{{$user->name}}</h1>
                <span>{{$role->display}}</span>
            </div>
        </div>        
    </div> 
    @if ($user->username == Auth::user()->username)
    <div class=" ml-3 mb-3">
        <a href="/admin/{{$user->username}}/edit" class="btn btn-primary mt-3">Edit Profile</a>
        <a href="/admin/{{$user->username}}/editPassword" class="btn btn-secondary mt-3">Change Password</a>
    </div>
    @endif

</div>

<div class="border rounded-top mt-3 d-flex justify-content-start flex-column">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if ($user_tabs=='about') text-dark and Active  @endif"
                href="/user/{{$user->username}}/about" style="color: rgba(0, 0, 0, 0.466)">About</a>
        </li>
        @if ($user->roleID == 7 || $user->roleID == 8 || $user->roleID == 9 || $user->roleID == 10)
        <li class="nav-item" onclick="">
            <a class="nav-link @if ($user_tabs=='projects') text-dark and Active @endif"
            href="/user/{{$user->username}}/projects" style="color: rgba(0, 0, 0, 0.466)">Projects</a>
        </li>
        @endif
    </ul>

    <div class="ms-5 mt-4 mb-4 mr-5">
        @if ($user_tabs=='about')
        {{-- Name --}}
        <div class="row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->name}}">
            </div>
        </div>

        {{-- Username --}}
        <div class="row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->username}}">
            </div>
        </div>

        {{-- Email --}}
        <div class="row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->email}}">
            </div>
        </div>

        {{-- Date of Birth --}}
        <div class="row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Date Of Birth</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                    value="{{ $user->dateOfBirth->format('d-m-Y') }}">
            </div>
        </div>

       

        @elseif ($user_tabs=='projects')
        <table class="table">
            <thead>
                <tr class="bg-danger text-white">
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($projects->isEmpty())
                <tr>
                    <td>There are no projects available</td>
                </tr>
                @else
                @foreach ($projects as $project)
                <tr>
                    <td class="col-1">{{$id++}}</td>
                    <td class="col-3">{{ $project->title }}</td>
                    @if ($project->deptID == 3)
                        <td class="col-3">IT Customer Relationship Management</td>
                    @endif
                    @if ($project->deptID == 4)
                        <td class="col-3">IT Branch Delivery System</td>
                    @endif
                    @if ($project->deptID == 5)
                        <td class="col-3">IT Micro and Retail Core Loan System</td>
                    @endif
                    @if ($project->deptID == 6)
                        <td class="col-3">IT IT Internal Application</td>
                    @endif
                    <td class="col-2">{{ $project->status->name }}</td>
                    <td class="col-1">{{ $project->startDate->format('d-m-Y') }}</td>
                    <td class="col-1">{{ $project->endDate->format('d-m-Y') }}</td>
                    <td class="col-1">
                        <div class="d-flex flex-row">
                            <div class="col-sm-auto d-flex flex-row">
                                <form method="GET" action="{{ route('download_file') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type='hidden' name="filePath" value="{{ $project->sysRequirements }}">
                                        {{-- <input  class=""> --}}

                                        {{-- <a type="submit"  value="Download"></a> --}}

                                        <button type="submit" class="" value="Download" style="border: none;
                                        background: none;"><span data-feather="download"></span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-auto">
                                <a class="text-decoration-none" href="{{ route('project_detail_view', [$project->id, 'tasks']) }}" style="color: black"><span data-feather="eye"></span></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {!! $projects->appends(\Request::except('page'))->render() !!}
        @endif
    </div>
</div>



@endsection

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>