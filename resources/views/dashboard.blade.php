@extends('dashboard_layout')

@section('title', 'Dashboard')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-1">
            <div class="main-value" id="days_remaining">{{ $days_remaining }}</div>
            <div class="main-description"># of days left before License expires.</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-2">
            <div class="main-value">@if ($license_active)
                ACTIVE
            @else
                INACTIVE
            @endif</div>
            <div class="main-description">@if (Auth::user()->acc_type == 'R')
                Recreational
            @elseif (Auth::user()->acc_type == 'C')
                Commercial
            @endif license.</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-3">
            <div class="main-value">{{ Auth::user()->rpases->count() }}</div>
            <div class="main-description"># registered RPAS.</div>
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


<script src="/js/dashboard.js"></script>
@endsection