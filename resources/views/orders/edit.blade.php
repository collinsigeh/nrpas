@extends('dashboard_layout')

@section('title', 'Edit package')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Edit order</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="bg-light p-4">
                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="form-group mb-4">
                            <label for="customer">Order by</label>
                            <input type="text" id="customer" name="customer" class="form-control" value="{{ $order->user->profile->firstname.' ('.$order->user->email.')' }}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="name">Item name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $order->package->name }}" disabled>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label for="validity">Validity (Years)</label>
                                    <input type="number" id="validity" name="validity" class="form-control" value="{{ $order->validity }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label for="price">Price (@include('inc.currency_symbol'))</label>
                                    <input type="text" id="price" name="price" class="form-control" value="{{ $order->price }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label for="discount_amount">Discount (@include('inc.currency_symbol'))</label>
                                    <input type="text" id="discount_amount" name="discount_amount" class="form-control" value="{{ $order->discount_amount }}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label for="final_amount">Amount billed (@include('inc.currency_symbol'))</label>
                                    <input type="text" id="final_amount" name="final_amount" class="form-control" value="{{ $order->final_amount }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="amount_paid">Amount paid (@include('inc.currency_symbol'))</label>
                            <input type="text" id="amount_paid" name="amount_paid" class="form-control" value="@if (old('amount_paid')){{ old('amount_paid')}}@else{{ $order->amount_paid }}@endif" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="Activate" @if (old('status') == 'Activate') checked @endif required>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Activate
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="Do NOT activate" @if (old('status') == 'Do NOT activate') checked @endif required>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Do NOT activate
                                </label>
                              </div>
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