@extends('dashboard_layout')

@section('title', 'Dashboard')

@section('content')
@include('inc.alert_messages')
<div class="row counters">
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-1">
            <div class="main-value counter" data-target="{{ $total_users }}">0</div>
            <div class="main-description"># end-users</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-2">
            <div class="main-value counter" data-target="{{ $total_rpas }}">0</div>
            <div class="main-description"># registered rpas</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-3">
            <div class="main-value counter" data-target="{{ $total_orders }}">0</div>
            <div class="main-description"># subscription orders</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-9">
        <div id="welcome_box">
            <h3 id="today"></h3>
            <p>Welcome to your profile, <b>{{ ucwords($user->profile->firstname) }}</b>!</p>
        </div>
    </div>
</div>

@endsection