@extends('dashboard_layout')

@section('title', 'My subscriptions')

@section('content')
@include('inc.alert_messages')
<div class="row" id="admin_body">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">My subscriptions</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>

          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%; font-size: 12px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>Package</th>
                  <th>Price (@include('inc.currency_symbol'))</th>
                  <th>Discount received (@include('inc.currency_symbol'))</th>
                  <th>Amount paid (@include('inc.currency_symbol'))</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>
                            <b>{{ $subscription->package->name }}</b><br>
                            <small class="text-muted">{{ 'Valid for '.$subscription->validity.Str::plural('year', $subscription->validity) }}</small>
                        </td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($subscription->price, 2, '.')}}
                        </td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($subscription->discount_amount, 2, '.')}}
                        </td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($subscription->final_amount, 2, '.')}}
                        </td>
                        <td>
                            <b>
                                @if ($subscription->is_activated)
                                    <span class="text-success">Completed</span><br>
                                    <small class="text-muted">Activated on {{ date('d M, Y', strtotime($subscription->activated_at)) }}</small>
                                @else
                                    @if ($subscription->is_payment_confirmed)
                                        <span class="text-success">Paid</span><br>
                                        <small class="text-muted">Confirmed on {{ date('d M, Y', strtotime($subscription->payment_confirmed_at)) }}</small>
                                    @else
                                        <span class="text-danger">Unpaid</span><br>
                                        <small class="text-muted">Requested on {{ date('d M, Y', strtotime($subscription->created_at)) }}</small>
                                    @endif
                                @endif
                            </b>
                        </td>
                        <td class="text-end">
                            @if (!$subscription->is_payment_confirmed)
                                <a href="{{ route('subscriptions.make_payment', $subscription->id)}}" class="btn btn-sm btn-primary mb-2">Make payment</a>
                                <form action="{{ route('orders.destroy', $subscription->id)}}" method="post" style="display: inline-block">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-sm btn-danger mb-2">Cancel order</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

    </div>
</div>
@endsection