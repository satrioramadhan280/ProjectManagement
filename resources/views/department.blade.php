
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
        Department
@endsection

@section('content')

    <h1>Department</h1>
    <div class="d-flex flex-wrap justify-content-around mt-3">
        <div class="p-3">
            <div class="card" style="width: 500px">
                <h5 class="card-header">IT Customer Relationship Management</h5>
                <div class="card-body">
                    @foreach ($department1 as $department1)
                        <a class="d-flex flex-row text-decoration-none text-dark user-record border ms-3 mt-2 rounded p-2" href="/user/{{$department1->username}}/about">
                            <div class="d-flex align-items-center">
                                <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$department1->photo)}}" height="35px" width="35px" alt="">
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <span class="head-text">{{$department1->name}}</span>
                                <span class="role-text">{{$role[$department1->roleID-1]->display}}</span>
                            </div>
                        </a>
                    @endforeach
                  <div class="d-flex justify-content-end">
                    <a href="/department/{{$role[6]->display}}" class="btn btn-primary mt-4 ">See More</a>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="p-3">
            <div class="card" style="width: 500px">
                <h5 class="card-header">IT Branch Delivery System</h5>
                <div class="card-body">
                    @foreach ($department2 as $department2)
                        <a class="d-flex flex-row text-decoration-none text-dark user-record border ms-3 mt-2 rounded p-2" href="/user/{{$department2->username}}/about">
                            <div class="d-flex align-items-center">
                                <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$department2->photo)}}" height="35px" width="35px" alt="">
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <span class="head-text">{{$department2->name}}</span>
                                <span class="role-text">{{$role[$department2->roleID-1]->display}}</span>
                            </div>
                        </a>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <a href="/department/{{$role[7]->display}}" class="btn btn-primary mt-4 ">See More</a>
                      </div>
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="card" style="width: 500px">
                <h5 class="card-header">IT Micro and Retail Core Loan System</h5>
                <div class="card-body">
                    @foreach ($department3 as $department3)
                        <a class="d-flex flex-row text-decoration-none text-dark user-record border ms-3 mt-2 rounded p-2" href="/user/{{$department3->username}}/about">
                            <div class="d-flex align-items-center">
                                <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$department3->photo)}}" height="35px" width="35px" alt="">
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <span class="head-text">{{$department3->name}}</span>
                                <span class="role-text">{{$role[$department3->roleID-1]->display}}</span>
                            </div>
                        </a>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <a href="/department/{{$role[8]->display}}" class="btn btn-primary mt-4 ">See More</a>
                      </div>
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="card" style="width: 500px">
                <h5 class="card-header">IT Internal Application</h5>
                <div class="card-body">
                    @foreach ($department4 as $department4)
                        <a class="d-flex flex-row text-decoration-none text-dark user-record border ms-3 mt-2 rounded p-2" href="/user/{{$department4->username}}/about">
                            <div class="d-flex align-items-center">
                                <img class="pp-changepic rounded-circle border border-3 " src="{{asset("img/users_photo/".$department4->photo)}}" height="35px" width="35px" alt="">
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <span class="head-text">{{$department4->name}}</span>
                                <span class="role-text">{{$role[$department4->roleID-1]->display}}</span>
                            </div>
                        </a>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <a href="/department/{{$role[9]->display}}" class="btn btn-primary mt-4 ">See More</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


