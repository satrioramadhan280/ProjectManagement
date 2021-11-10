@extends('layouts.app')

@section('title')
    Add New Employee
@endsection

@section('content')
<form class="form-horizontal" action='{{ route('register') }}' method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
      <div id="legend">
        <legend class="">Add New Employee</legend>
      </div>
      <div class="control-group">     
        <label class="control-label"  for="firstName">First Name</label>
        <div class="controls">
          <input type="text" id="firstName" name="firstName" placeholder="" class="input-xlarge">
        </div>
      </div>
      <div class="control-group">  
        <label class="control-label"  for="lastName">Last Name</label>
        <div class="controls">
          <input type="text" id="lastName" name="lastName" placeholder="" class="input-xlarge">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"  for="username">Username</label>
        <div class="controls">
          <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        </div>
      </div>
   
      <div class="control-group">
        <label class="control-label" for="email">E-mail</label>
        <div class="controls">
          <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="dateofBirth">Date of Birth</label>
        <div class="controls">
          <input type="date" id="dateofBirth" name="dateofBirth" placeholder="" class="input-xlarge">
        </div>
      </div>
   
      <div class="control-group">
        <label class="control-label" for="role">Select Department</label>
        <div class="controls">
            <select class="custom-select" id="roleID" name="roleID" >
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
      </div>
   
      <div class="control-group">
        <div class="controls">
          <button class="btn btn-success" type="submit">Register</button>
        </div>
      </div>
    </fieldset>
  </form>
@endsection
