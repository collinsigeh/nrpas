@extends('dashboard_layout')

@section('title', 'Dashboard')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-xl-9">
        <div class="alert alert-info text-center text-md-start" style="line-height: 3em;">
            You do not have an active subscription. <a href="{{ route('orders.create') }}" class="btn btn-primary">Subscribe Now</a>
        </div>
        @if ($unpaid_subs > 0)
            <div class="alert alert-info text-center text-md-start" style="line-height: 3em;">
                You have {{ $unpaid_subs }} unpaid {{ Str::plural('subscription', $unpaid_subs) }}. <a href="{{ route('subscriptions.index') }}" class="btn btn-primary">View list</a>
            </div>
        @endif
    </div>
</div>
<div class="row counters">
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-1">
            <div class="main-value counter" data-target="{{ $days_remaining }}" id="days_remaining">0</div>
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
            <div class="main-value counter" data-target="{{ Auth::user()->rpases->count() }}">0</div>
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