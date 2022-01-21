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
    <hr>
    <div class="control-group">
      <label class="control-label" for="name">Name</label>
      <div class="controls">
        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror">
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
        <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
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
        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{old('dateOfBirth')}}" class="form-control @error('dateOfBirth') is-invalid @enderror" value="">
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
          <option value="{{$role->id}}" {{old('roleID') == $role->id ? 'selected' : ''}}>{{$role->display}}</option>
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