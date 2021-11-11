
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
    }

    .user-info{
        position: relative;
        left: 250px;
    }
</style>



@extends('layouts.app')

@section('title')
        {{$user->username}}
@endsection

@section('content')
    {{-- {{$user->name}}
    {{$user->email}} --}}
    
    <div class="border rounded">
        <div class="d-flex bg-warning  bg-danger " style="height: 250px;">
                
        </div>
        
        <div class="pp-pos" style="height: 20px;" >
            <img class="pp-changepic rounded-circle border border-white" src="{{asset("img/".$user->photo)}}" height="200px" width="200px" alt="">     
            <div class="hide span-changepic" style="width: 110px;height: 32px;">
                <div class="title-border d-flex justify-content-center rounded-pill border border-dark" style="width: 110px;height: 32px;">
                    <a class="d-flex m-1 changepp-title" height="10px" width="10px" style="text-decoration: none;color: black" ><img src="{{asset("img/icons/pencil.png")}}" alt="pencil-icon" height="13px" width="14px">Change Picture</a>    
                </div>
            </div>
            
        </div>
        <div class="d-flex flex-column" style="height: 124px">
            <div class="d-flex mr-5">
                <div class="d-flex user-info flex-column">
                    <h1>Derick Yudanegara</h1>
                    <span>Role : Branch Delivery System</span>
                </div>
            </div>
        </div>
        

    </div>
    

@endsection
