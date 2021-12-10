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
      <legend class="">Edit Profile</legend>
    </div>
    <div class="control-group">
      <label class="control-label" for="firstName">First Name</label>
      <div class="controls">
        @can('Admin')
          <input readonly type="text" id="firstName" name="firstName" placeholder="{{old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror" value="{{$user->firstName}}">
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
          <input  type="text" id="firstName" name="firstName" placeholder="{{old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror" value="{{$user->firstName}}">
        @endcanany
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
        @can('Admin')
          <input readonly type="text" id="lastName" name="lastName" placeholder="{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" value="{{$user->lastName}}">
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
          <input type="text" id="lastName" name="lastName" placeholder="{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" value="{{$user->lastName}}">
        @endcanany
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
        @can('Admin')
          <input readonly type="text" id="username" name="username" placeholder="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}">
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
          <input type="text" id="username" name="username" placeholder="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}">
        @endcanany
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
        @can('Admin')
         <input readonly type="text" id="email" name="email" placeholder="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
         <input type="text" id="email" name="email" placeholder="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
        @endcanany
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
        @can('Admin')
          <input readonly type="date" id="dateOfBirth" name="dateOfBirth" placeholder="{{old('dateOfBirth')}}" class="form-control @error('dateOfBirth') is-invalid @enderror" value="{{$user->dateOfBirth}}">
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
          <input type="date" id="dateOfBirth" name="dateOfBirth" placeholder="{{old('dateOfBirth')}}" class="form-control @error('dateOfBirth') is-invalid @enderror" value="{{$user->dateOfBirth}}">
        @endcanany
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
        @can('Admin')
          <select class="custom-select form-control mb-1 @error('roleID') is-invalid @enderror" id="roleID" name="roleID">
            @foreach($roles as $role)
              <option value="{{$user->roleID}}" {{(old('role') == $user->userID) ? 'selected':''}}>{{$role->display}}</option>
            @endforeach
        @endcan
        @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
          <select  {{ $user->roleID ? 'readonly' : ''}} class="custom-select form-control mb-1 @error('roleID') is-invalid @enderror" id="roleID" name="roleID">
          @foreach($roles as $role)
            <option readonly value="{{$user->roleID}}" {{(old('role') == $user->userID) ? 'selected':''}}>{{$role->display}}</option>
          @endforeach
        @endcanany
        
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
      </form>
      @can('Admin')
        <form action="/admin/{{$user->username}}/delete" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Are you sure want to delete this user?')" class="btn btn-danger" >Delete User</button>
        </form>
      @endcan  
      </div>
    </div>
  </fieldset>
@endsection