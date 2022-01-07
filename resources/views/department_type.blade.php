
<style>
    .user-record:hover{
        cursor: pointer;
    }
    .head-text{
        font-size: 17px;
    }
    .role-text{
        font-size: 13px;
        color: rgba(0, 0, 0, 0.733);
    }
</style>

@extends('layouts.app')

@section('title')
        Department Members
@endsection

@section('content')

    <h1>Department Members</h1>
    <div class="d-flex flex-wrap justify-content-around mt-3">
        <div class="p-3 justify-content-center">
            <div class="card" style="width: 1000px">
                <h5 class="card-header">IT Customer Relationship Management</h5>
                <div class="card-body">
                    @foreach ($user as $user_obj)
                        <a class="d-flex flex-row text-decoration-none text-dark user-record border ms-3 mt-2 rounded p-2" href="/user/{{$user_obj->username}}/about">
                            <div class="d-flex align-items-center">
                                <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$user_obj->photo)}}" height="35px" width="35px" alt="">
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <span class="head-text">{{$user_obj->name}}</span>
                                <span class="role-text">{{$role[$user_obj->roleID-1]->display}}</span>
                            </div>
                        </a>
                    @endforeach
                  
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $user->links() }}
                </div>
                
            </div>
        </div>
        
      
    </div>
    
@endsection

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


