@extends('web_layout')

@section('title', '')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      </div>
      <div class="col-8 offset-2">
          <div class="alert alert-info">
            Ooops! Your current browsing session has expired.
          </div>
          @guest
          <div class="mt-4 text-center">
              <a href="{{route('login')}}" class="my-custom-primary-web-button">Re-login to Account</a>
              <a href="{{route('register')}}" class="my-custom-secondary-web-button">Create New Account</a>
          </div>
          @else
          <div class="mt-4 text-center">
              <a href="{{route('dashboard')}}" class="my-custom-link">Return home</a>
          </div>
          @endguest
      </div>
  </div>
</div>
@endsection