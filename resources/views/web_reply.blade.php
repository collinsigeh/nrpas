@extends('web_layout')

@section('title', '')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      </div>
      <div class="col-md-8 offset-md-2">
          {!! $message !!}
          @guest
          <div class="mt-4 text-center">
              <a href="{{route('login')}}" class="my-custom-primary-web-button">Login to Account</a>
              <a href="{{route('register')}}" class="my-custom-secondary-web-button">Create New Account</a>
          </div>
          @else
          <div class="mt-4 text-center">
              <a href="{{route('dashboard')}}" class="my-custom-primary-web-button">Home</a>
          </div>
          @endguest
      </div>
  </div>
</div>
@endsection