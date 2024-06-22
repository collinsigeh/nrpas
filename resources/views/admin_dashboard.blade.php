@extends('dashboard_layout')

@section('title', 'Dashboard')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-xl-9">
        @if ($active_packages < 1)
            <div class="alert alert-info text-center text-md-start" style="line-height: 3em;">
                <p>There is <b>no active subscription package</b> for users to buy.</p>
                <a href="{{ route('packages.create') }}" class="btn btn-primary">Create new package</a>
                @if ($all_packages > 0)
                    <a href="{{ route('packages.index') }}" class="btn btn-primary">View existing packages</a>
                @endif
            </div>
        @endif
    </div>
</div>
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

<script src="/js/dashboard.js"></script>
@endsection