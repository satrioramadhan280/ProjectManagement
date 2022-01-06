@extends('layouts.app')

@section('title')
Add New User
@endsection

@section('content')
<form class="form-horizontal" action='/admin/addUser' method="POST" enctype="multipart/form-data">
  @csrf
  <fieldset>
    <div id="legend">
      <legend class="">Add New User</legend>
    </div>
    <div class="control-group">
      <label class="control-label" for="firstName">First Name</label>
      <div class="controls">
        <input type="text" id="firstName" name="firstName" placeholder="{{old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror">
        @error('firstName')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="lastName">Last Name</label>
      <div class="controls">
        <input type="text" id="lastName" name="lastName" placeholder="{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror">
        @error('lastName')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="{{old('username')}}" class="form-control @error('username') is-invalid @enderror">
        @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="dateOfBirth">Date of Birth</label>
      <div class="controls">
        <input type="date" id="dateOfBirth" name="dateOfBirth" placeholder="{{old('dateOfBirth')}}" class="form-control @error('dateOfBirth') is-invalid @enderror" value="">
        @error('dateOfBirth')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="role">Select Department</label>
      <div class="controls">
        <select class="custom-select form-control mb-1 @error('roleID') is-invalid @enderror" id="roleID" name="roleID">
          <option value="">Select Department</option>
          @foreach ($roles as $role)
          <option value="{{$role->id}}">{{$role->display}}</option>
          @endforeach
        </select>
        @error('roleID')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
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