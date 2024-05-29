@extends('web_layout')

@section('title', 'Reset Your Account Password')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      <div class="col-md-10 offset-md-1">
          <div class="row">
              <div class="col-md-6">
                  <div class="text-center pb-4">
                      <h1 class="my-custom-title">Reset Your Password</h1>
                  </div>

                  @include('inc.alert_messages')

                  <form action="{{ route('password.reset.post') }}" method="post" class="mt-4">
                      @csrf
      
                      <input type="hidden" name="confirmation_code" value="{{ $confirmation_code }}">
      
                      <div class="mb-4">
                          <input type="password" name="password" class="form-control" placeholder="PASSWORD" value="{{ old('password') }}" required>
                      </div>
      
                      <div class="mb-4">
                          <input type="password" name="password_confirmation" class="form-control" placeholder="PASSWORD CONFIRMATION" value="{{ old('password_confirmation') }}" required>
                          <small class="text-muted">Password must be at least 8 characters in length and contain at least one upper case letter, one lower case letter, one number, and one special character (e.g. !, @, #, %, etc.)</small>
                      </div>
      
                      <input type="submit" value="Reset Password" class="my-custom-primary-button">
                  </form>
                  <div class="mt-4 text-center">
                      <span class="text-muted">Already have an account? </span><a href="{{ route('login') }}" class="my-custom-link">Back to Login</a>
                  </div>
                  <div style="height: 50px"></div>
              </div>
              <div class="col-md-6 p-4 text-center">
                  <img src="/images/register.png" alt="" width="100%">
              </div>
          </div>
      </div>
  </div>
</div>
@endsection