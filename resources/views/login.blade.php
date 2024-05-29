@extends('web_layout')

@section('title', 'Login')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      <div class="col-md-12 text-center">
          <h1 class="my-custom-title">Login or Create Account</h1>
      </div>

      <div class="col-8 offset-2">
          @include('inc.alert_messages')

          <form action="{{ route('login.post') }}" method="post" class="mt-4">
              @csrf

              <div class="mb-4">
                  <input type="email" name="email" class="form-control" placeholder="EMAIL" value="{{ old('email') }}" required>
              </div>
              <div class="mb-4">
                  <input type="password" name="password" class="form-control" placeholder="PASSWORD" value="{{ old('password') }}" required>
              </div>

              <input type="submit" value="Login" class="my-custom-primary-button">
          </form>
          <div class="mt-4 text-center">
              <a href="{{ route('password.forget') }}" class="my-custom-link">Forgot Password?</a> |
              <a href="{{ route('register') }}" class="my-custom-link">Create New Account</a>
          </div>
      </div>
  </div>
</div>
@endsection