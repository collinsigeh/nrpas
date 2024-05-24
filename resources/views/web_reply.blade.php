@extends('web_layout')

@section('title', '')

@section('content')
    <div class="row">
        </div>
        <div class="col-8 offset-2">
            {!! $message !!}
            @guest
            <div class="mt-4 text-center">
                <a href="{{route('login')}}" class="my-custom-primary-web-button">Login to Account</a>
                <a href="{{route('register')}}" class="my-custom-secondary-web-button">Create New Account</a>
            </div>
            @else
            <div class="mt-4 text-center">
                <a href="{{route('dashboard')}}" class="my-custom-link">Home</a>
            </div>
            @endguest
        </div>
    </div>
@endsection