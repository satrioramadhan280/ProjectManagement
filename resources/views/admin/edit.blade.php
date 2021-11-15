@extends('layouts.app')

@section('title')
Edit Employee
@endsection

@section('content')
<form class="form-horizontal" action='/admin/editUser/{{$user->username}}' method="POST" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <fieldset>
    <div id="legend">
      <legend class="">Edit Employee</legend>
    </div>
    <div class="control-group">
      <label class="control-label" for="firstName">First Name</label>
      <div class="controls">
        <input type="text" id="firstName" name="firstName" placeholder="{{old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror" value="{{$user->firstName}}">
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
        <input type="text" id="lastName" name="lastName" placeholder="{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" value="{{$user->lastName}}">
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
        <input type="text" id="username" name="username" placeholder="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}">
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
        <input type="text" id="email" name="email" placeholder="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="dateofBirth">Date of Birth</label>
      <div class="controls">
        <input type="date" id="dateofBirth" name="dateofBirth" placeholder="{{old('dateOfBirth')}}" class="form-control @error('dateOfBirth') is-invalid @enderror" value="{{$user->dateOfBirth}}">
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
            {{-- <option value="">Select Department</option> --}}
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (old("roleID") == $role->id ? "selected":"") }}>{{ $role->display }}</option>
          {{-- <option value="{{$role->id}}">{{$role->display}}</option> --}}
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
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </div>
  </fieldset>
</form>
@endsection