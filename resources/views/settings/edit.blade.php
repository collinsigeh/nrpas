@extends('dashboard_layout')

@section('title', 'Settings')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Settings</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="bg-light p-4">
                    <form action="{{ route('settings.update') }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="form-group mb-4">
                            <label for="paystack_public_key">Paystack public key</label>
                            <input type="text" id="paystack_public_key" name="paystack_public_key" class="form-control" value="@if ($setting) {{ $setting->paystack_public_key }} @endif" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="paystack_secret_key">Paystack secret key</label>
                            <input type="text" id="paystack_secret_key" name="paystack_secret_key" class="form-control" value="@if ($setting) {{ $setting->paystack_secret_key }} @endif" required>
                        </div>
                        <div class="mb-4 text-center">
                            <input type="submit" value="Save" class="my-custom-primary-web-button" style="font-size: 18px; padding: 8px 22px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection