@extends('dashboard_layout')

@section('title', 'My Profile')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">My Profile</h2>

        <div style="border-top: 1px dotted #333;">

            @include('inc.alert_messages')
    
            <form action="{{ route('profile.update') }}" method="post" class="mt-4 small-form">
                @csrf
    
                <h4>Personal Contact Information</h4>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <input type="text" name="firstname" placeholder="FIRST NAME" value="{{ $user->profile->firstname }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="lastname" placeholder="LAST NAME" value="{{ $user->profile->lastname }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="middlename" placeholder="MIDDLE NAME (Optional)" value="{{ $user->profile->middlename }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="email" name="email" placeholder="EMAIL" value="{{ $user->email }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="phone" placeholder="PHONE" value="{{ $user->profile->phone }}" class="form-control" required>
                    </div>
                </div>
                <h4>Address</h4>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <input type="text" name="country" placeholder="COUNTRY" value="{{ $user->profile->country }}" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <input type="text" name="street_address" placeholder="ADDRESS (Enter Street Address)" value="{{ $user->profile->street_address }}" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <input type="text" name="apt_no" placeholder="ADDRESS (Enter Apartment, suite, or Unit)" value="{{ $user->profile->apt_no }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="city" placeholder="CITY (Enter City)" value="{{ $user->profile->city }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="state" placeholder="STATE/PROVINCE/REGION" value="{{ $user->profile->state }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="postcode" placeholder="POSTAL CODE (Enter your postcode)" value="{{ $user->profile->postcode }}" class="form-control">
                    </div>
                </div>
                <h4>Organization Information</h4>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <input type="text" name="org_name" placeholder="ORGANIZATION NAME" value="{{ $user->profile->org_name }}" class="form-control">
                    </div>
                    <div class="col-md-12 mb-4">
                        <input type="text" name="rcc_no" placeholder="DBA (RCC NUMBER)" value="{{ $user->profile->rcc_no }}" class="form-control">
                    </div>
                </div>
    
                <div class="mt-4 text-center">
                    <input type="submit" value="Update" class="my-custom-primary-web-button" style="font-size: 18px; padding: 8px 22px;">
                    <a href="{{ route('dashboard')}}" class="my-custom-secondary-web-button">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection