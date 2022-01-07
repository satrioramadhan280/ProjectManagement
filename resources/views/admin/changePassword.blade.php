@extends('layouts.app')

@section('title')
Edit Employee
@endsection

@section('content')
<form class="form-horizontal" action='/admin/{{$user->username}}/changePassword' method="POST" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="newPassword">New Password</label>
      <div class="controls">
          <input type="password" id="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror">
        @error('newPassword')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="confirmPassword"> Confirm New Password</label>
      <div class="controls">
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group mt-2">
      <div class="controls">
        <button class="btn btn-primary" type="submit">Change Password</button>
      </div>
    </div>
  </fieldset>
</form>
@endsection