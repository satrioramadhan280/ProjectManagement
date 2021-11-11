@extends('layouts.app')

@section('title')
    Add New Employee
@endsection

@section('content')
<form class="form-horizontal" action='/admin/addUser' method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
      <div id="legend">
        <legend class="">Add New Employee</legend>
      </div>
      <div class="control-group">     
        <label class="control-label"  for="firstName">First Name</label>
        <div class="controls">
          <input type="text" id="firstName" name="firstName" placeholder="" class="form-control">
        </div>
      </div>
      <div class="control-group">  
        <label class="control-label"  for="lastName">Last Name</label>
        <div class="controls">
          <input type="text" id="lastName" name="lastName" placeholder="" class="form-control">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"  for="username">Username</label>
        <div class="controls">
          <input type="text" id="username" name="username" placeholder="" class="form-control">
        </div>
      </div>
   
      <div class="control-group">
        <label class="control-label" for="email">E-mail</label>
        <div class="controls">
          <input type="text" id="email" name="email" placeholder="" class="form-control">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="dateofBirth">Date of Birth</label>
        <div class="controls">
          <input type="date" id="dateofBirth" name="dateofBirth" placeholder="" class="form-control" value="">
        </div>
      </div>
   
      <div class="control-group">
        <label class="control-label" for="role">Select Department</label>
        <div class="controls">
            <select class="custom-select form-control mb-1" id="roleID" name="roleID" >
              <option value="">Select Department</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->display}}</option>
                @endforeach
            </select>
        </div>
      </div>
   
      <div class="control-group">
        <div class="controls">
          <button class="btn btn-primary" type="submit">Register</button>
        </div>
      </div>
    </fieldset>
  </form>
@endsection
