@extends('web_layout')

@section('title', 'Profile Completion')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="my-custom-title">Complete Your Profile</h1>
            <p>To Register, complete the form below and click <b>Proceed</b></p>
        </div>

        @include('inc.alert_messages')

        <form action="{{ route('profile.store') }}" method="post" class="mt-4">
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
                    </select>
                </div>
                <div class="col-md-6 mb-4">
                    <input type="text" name="firstname" placeholder="FIRST NAME" value="{{ old('firstname') }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-4">
                    <input type="text" name="lastname" placeholder="LAST NAME" value="{{ old('lastname') }}" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
                <input type="submit" value="Proceed" class="my-custom-primary-button">
            </div>
        </form>
    </div>
@endsection