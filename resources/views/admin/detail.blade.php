
<style>
    .pp-pos{
        position: relative;
        left: 30px;
        bottom: 90px;
    }

    .hide {
        display: none;
    }
    
    .pp-changepic:hover + .hide {
        display: block;
        color: black;
        color: black;
        text-decoration: none;
    }

    .span-changepic{
        position: relative;
        left: 60px;
        bottom: 170px;
        text-decoration: none;
        opacity: 0.7;
        font-size: 12px;
    }

    .span-changepic:hover{
        display: block;
        color: black;
        text-decoration: none;
        opacity: 1.0;
        
    }

    .changepp-tittle{
        text-decoration: none;
        color: black;
        
    }

    .changepp-title:hover{
        color: black;
        text-decoration: none;
    }

    .title-border:hover{
        background-color: rgba(243, 243, 243, 0.658);
        cursor: pointer;
    }

    .user-info{
        position: relative;
        left: 250px;
    }
</style>

@extends('layouts.app')

@section('title')
        {{$user->firstName}} {{$user->lastName}}
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
        
        <div class="pp-pos" style="height: 20px;" >
            <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$user->photo)}}" height="200px" width="200px" alt="">     
            <div class="hide span-changepic" style="width: 110px;height: 32px;">
                <div class="title-border d-flex justify-content-center rounded-pill border border-dark" style="width: 110px;height: 32px;">
                    <a data-toggle="modal" data-target="#exampleModalCenter" class="d-flex m-1 changepp-title" height="10px" width="10px" style="text-decoration: none;color: black" ><img src="{{asset("img/icons/pencil.png")}}" alt="pencil-icon" height="13px" width="14px">Change Picture</a>    
                </div>
            </div>
        </div>

        <!-- Modal -->
        <form method="POST"  name="updatepp_field" action="/update/profile_picture/{{$user->id}}" class="ml-3" enctype="multipart/form-data" >
            @csrf
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <h1>{{$user->firstName}} {{$user->lastName}}</h1>
                    <span>Role : {{$role->display}}</span>
                </div>
            </div>
        </div>
        

    </div>

    <div class="border rounded-top mt-3 d-flex justify-content-start flex-column">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link @if ($user_tabs=='about') text-dark and Active  @endif" href="/user/{{$user->username}}/about" style="color: rgba(0, 0, 0, 0.466)">About</a>
            </li>
            @cannot('Admin') 
            <li class="nav-item" onclick="">
                <a class="nav-link @if ($user_tabs=='projects') text-dark and Active @endif" href="/user/{{$user->username}}/projects" style="color: rgba(0, 0, 0, 0.466)">Projects</a>
            </li>
            @endcannot
           
        </ul>
        <div class="ms-5 mt-4 mb-4">
            @if ($user_tabs=='about')
                {{-- Date of Birth --}}
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Date Of Birth</label>
                    <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->dateOfBirth}}">
                    </div>
                </div>

                {{-- Username --}}
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                    <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->username}}">
                    </div>
                </div>

                {{-- First name --}}
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->firstName}}">
                    </div>
                </div>

                {{-- Last Name --}}
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->lastName}}">
                    </div>
                </div>


                {{-- Email --}}
                <div class="row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->email}}">
                    </div>
                </div>
            @elseif ($user_tabs=='projects')

            @endif
            
        </div>
        
    </div>
 
    <div class="d-inline">
        <a href="/admin/{{$user->username}}/edit" class="btn btn-primary c">Edit Profile</a>
        @cannot('Admin')
            <a href="/admin/{{$user->username}}/editPassword" class="btn btn-secondary">Change Password</a>
        @endcannot
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


