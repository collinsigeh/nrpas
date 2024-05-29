@extends('web_layout')

@section('title', 'Profile Completion')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      <div class="col-md-12 text-center">
          <h1 class="my-custom-title">Complete Your Profile</h1>
          <p>To Register, complete the form below and click <b>Proceed</b></p>
      </div>

      @include('inc.alert_messages')

      <form action="{{ route('profile.store') }}" method="post" class="mt-4 small-form">
          @csrf

          <div class="row">
              <div class="col-md-6 mb-4">
                      <input type="text" name="reg_no" value="{{ $user->reg_no }}" class="form-control" disabled>
              </div>
              <div class="col-md-6 mb-4">
                  <select name="suffix" class="form-select" required>
                      <option value="">SELECT SUFFIX</option>
                      <option value="Mr." @if (old('suffix') == 'Mr.') selected @endif>Mr.</option>
                      <option value="Mrs." @if (old('suffix') == 'Mrs.') selected @endif>Mrs.</option>
                      <option value="Miss" @if (old('suffix') == 'Miss') selected @endif>Miss</option>
                      <option value="Engr" @if (old('suffix') == 'Engr') selected @endif>Engr</option>
                      <option value="Dr." @if (old('suffix') == 'Dr.') selected @endif>Dr.</option>
                      <option value="Prof." @if (old('suffix') == 'Prof.') selected @endif>Prof.</option>
                  </select>
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="firstname" placeholder="FIRST NAME" value="{{ old('firstname') }}" class="form-control" required>
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="lastname" placeholder="LAST NAME" value="{{ old('lastname') }}" class="form-control" required>
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="middlename" placeholder="MIDDLE NAME (Optional)" value="{{ old('middlename') }}" class="form-control">
              </div>
              <div class="col-md-6 mb-4">
                  <input type="email" name="email" placeholder="EMAIL" value="{{ $user->email }}" class="form-control" disabled>
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="phone" placeholder="PHONE" value="{{ old('phone') }}" class="form-control" required>
              </div>
          </div>
          <h4>Address</h4>
          <div class="row">
              <div class="col-md-12 mb-4">
                  <input type="text" name="country" placeholder="COUNTRY" value="{{ old('country') }}" class="form-control" required>
              </div>
              <div class="col-md-12 mb-4">
                  <input type="text" name="street_address" placeholder="ADDRESS (Enter Street Address)" value="{{ old('street_address') }}" class="form-control" required>
              </div>
              <div class="col-md-12 mb-4">
                  <input type="text" name="apt_no" placeholder="ADDRESS (Enter Apartment, suite, or Unit)" value="{{ old('apt_no') }}" class="form-control" required>
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="city" placeholder="CITY (Enter City)" value="{{ old('city') }}" class="form-control">
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="state" placeholder="STATE/PROVINCE/REGION" value="{{ old('state') }}" class="form-control">
              </div>
              <div class="col-md-6 mb-4">
                  <input type="text" name="postcode" placeholder="POSTAL CODE (Enter your postcode)" value="{{ old('postcode') }}" class="form-control">
              </div>
          </div>
          <h4>Organization Information</h4>
          <div class="row">
              <div class="col-md-12 mb-4">
                  <input type="text" name="org_name" placeholder="ORGANIZATION NAME" value="{{ old('org_name') }}" class="form-control">
              </div>
              <div class="col-md-12 mb-4">
                  <input type="text" name="rcc_no" placeholder="DBA (RCC NUMBER)" value="{{ old('rcc_no') }}" class="form-control">
              </div>
          </div>

          <div class="mt-4">
              <input type="submit" value="Proceed" class="my-custom-primary-button" style="font-size: 18px; padding: 8px 22px;">
          </div>
      </form>
  </div>
</div>
@endsection