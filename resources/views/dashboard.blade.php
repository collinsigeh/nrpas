@extends('dashboard_layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-1">
            <div class="main-value">0</div>
            <div class="main-description"># of days left before License expires.</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-2">
            <div class="main-value">INACTIVE</div>
            <div class="main-description">Commercial license.</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="main-item main-item-3">
            <div class="main-value">0</div>
            <div class="main-description"># registered RPAS.</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-9">
        Welcome to your profile, {{ $user->profile->org_name }}
    </div>
</div>
@endsection