@extends('dashboard_layout')

@section('title', 'New subscription')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">New subscription</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>
        
        <label for="subscription">Select a subscription package</label>
        <div class="row mt-3">
            @foreach ($packages as $package)
                <div class="col-md-6 col-xl-4">
                    <div class="subscription-item">
                        <h5>{{ $package->name }}</h5>
                        <div>
                            <small class="text-muted">Valid for: </small>
                            {{ $package->validity.' '.Str::plural('year', $package->validity) }}
                        </div>
                        <div class="py-3">
                            @include('inc.currency_symbol') 
                            <span style="font-weight: 900; font-size: 18px;">
                                {{ number_format($package->price, 2, '.', ',') }}
                            </span>
                        </div>
                        <form action="{{ route('orders.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <input type="submit" value="Buy" class="my-custom-primary-web-button">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection