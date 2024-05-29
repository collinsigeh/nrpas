@extends('web_layout')

@section('title', 'Select Account Type')

@section('content')

<div class="container" id="main-body">
    <div style="height: 140px;"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="my-custom-title">Account Type</h1>
            <p>Select the account type that best fits your RPAS Drone usage.</p>
        </div>

        @include('inc.alert_messages')

        <div class="row" id="acc-types">
            <div class="col-md-6">
                <a href="{{ route('profile.type.store', 'recreational') }}">
                    <div class="acc-type">
                        <h2>Recreational or Private</h2>
                        <p>I fly my RPAS (drone) solely for <b>recreation</b>, and not for commercial or other non-hobby purposes.</p>
                        <img src="/images/remote-pic.png" alt="">
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('profile.type.store', 'commercial') }}">
                    <div class="acc-type">
                        <h2>Commercial or Government</h2>
                        <p>I fly my RPAS (drone) solely for <b>commercial, government or other non-hobby purposes</b>.</p>
                        <img src="/images/drone-pic.png" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection