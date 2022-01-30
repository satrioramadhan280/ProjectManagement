@extends('layouts.app')

@section('title')
Change Password
@endsection

@section('content')
<h4>Change Password</h4>
<hr>
<form class="form-horizontal" action='/admin/{{$user->username}}/changePassword' method="POST" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="newPassword">Current Password</label>
      <div class="controls">
          <input type="password" id="currentPassword" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" placeholder="Input Current Password">
        @error('currentPassword')
        <span class="invalid-feedback" role="alert">
          <strong>{{ 'Your current password not match.' }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="newPassword">New Password</label>
      <div class="controls">
          <input type="password" id="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Input New Password">
        @error('newPassword')
        <span class="invalid-feedback" role="alert">
          <strong>{{ 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character' }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="confirmPassword"> Confirm New Password</label>
      <div class="controls">
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm New Password">
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
        <a href="{{ old('redirect_to', URL::previous())}}" class="btn btn-light">Cancel</a>
      </div>
    </div>
  </fieldset>
</form>
@endsection