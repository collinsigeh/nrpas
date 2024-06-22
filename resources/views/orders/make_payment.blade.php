@extends('dashboard_layout')

@section('title', 'New subscription')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Make payment</h2>

        <div style="border-top: 1px dotted #333;"></div>
        
        <div class="row">
            <div class="col-md-8 col-xl-6 offset-md-2 offset-xl-3">
                <div class="item_summary">
                    <div style="border-bottom: 1px dotted #c5c5c5; margin-bottom: 15px;">
                        Item summary:
                    </div>
                    <small>
                        <div class="py-2">
                            <small class="text-muted">Subscription package:</small><br>
                            {{ $order->package->name }}
                        </div>
                        <div class="py-2">
                            <small class="text-muted">Validity:</small><br>
                            {{ $order->validity.' '.Str::plural('year', $order->validity) }}
                        </div>
                        <div class="py-2">
                            <small class="text-muted">Order date:</small><br>
                            <small><i>{{ date('d M, Y', strtotime($order->created_at)) }}</i></small>
                        </div>
                        <table class="table mt-4">
                            <tr>
                                <td>
                                    Price:
                                </td>
                                <td class="text-end">
                                    @include('inc.currency_symbol') {{ number_format($order->price, 2, '.', ',') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <small class="text-muted">Discount:</small>
                                </td>
                                <td class="text-end">
                                    @include('inc.currency_symbol') {{ number_format($order->disocunt, 2, '.', ',') }}
                                </td>
                            </tr>
                            <tr style="font-size: 16px;">
                                <td>
                                    Amount Due:
                                </td>
                                <td class="text-end">
                                    @include('inc.currency_symbol') <b>{{ number_format($order->final_amount, 2, '.', ',') }}</b>
                                </td>
                            </tr>
                        </table>
                    </small>
                </div>
                <div class="text-center">
                    @if ($setting)
                        <form id="paymentForm">
                            <div class="form-group">
                            <input type="hidden" id="email_address" value="{{ $order->user->email }}" required />
                            </div>
                            <div class="form-group">
                            <input type="hidden" id="amount" value="{{ $order->final_amount }}" required />
                            </div>
                            <div class="form-group">
                            <input type="hidden" id="ref" value="{{ $order->id }}" required />
                            </div>
                            <div class="form-group">
                            <input type="hidden" id="public_key" value="{{ $setting->paystack_public_key }}" required />
                            </div>
                            <div class="form-group">
                            <input type="hidden" id="first-name" value="{{ $order->user->profile->firstname }}" />
                            </div>
                            <div class="form-group">
                            <input type="hidden" id="last-name" value="{{ $order->user->profile->lastname}}" />
                            </div>
                            <div class="form-submit">
                            <button type="submit" onclick="payWithPaystack()" class="my-custom-primary-web-button"> Pay </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <p>Your payment cannot be processed at the moment because some import admin setting is missing.</p>
                            Please contact the admin.
                        </div>
                    @endif
                      <script>
                        const paymentForm = document.getElementById('paymentForm');
                        paymentForm.addEventListener("submit", payWithPaystack, false);

                        function payWithPaystack(e) {
                        e.preventDefault();

                        let handler = PaystackPop.setup({
                            key: document.getElementById("public_key").value, // Replace with your public key
                            email: document.getElementById("email_address").value,
                            amount: document.getElementById("amount").value * 100,
                            ref: document.getElementById("ref").value, 
                            onClose: function(){
                                alert('You did NOT complete the payment. Please try again or contact the admin.');
                            },
                            callback: function(response){
                                window.location.href = "{{ route('subscriptions.confirm_payment', $order->id) }}";
                                // let message = 'Payment complete! Reference: ' + response.reference;
                                // alert(message);
                            }
                        });

                        handler.openIframe();
                        }
                      </script>
                      <script src="https://js.paystack.co/v1/inline.js"></script>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection