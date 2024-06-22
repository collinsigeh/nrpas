@extends('dashboard_layout')

@section('title', 'Orders')

@section('content')
@include('inc.alert_messages')
<div class="row" id="admin_body">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Orders</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>

          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%; font-size: 12px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>Order by</th>
                  <th>Item</th>
                  <th>Validity</th>
                  <th>Discount given (@include('inc.currency_symbol'))</th>
                  <th>Amount billed (@include('inc.currency_symbol'))</th>
                  <th>Amount paid (@include('inc.currency_symbol'))</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <b>{{ $order->user->profile->firstname.' '.$order->user->profile->lastname }}</b><br>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>
                            {{ $order->package->name }}<br>
                            <small class="text-muted">
                                @include('inc.currency_symbol')
                                {{ number_format($order->price, 2, '.', ',')}}
                            </small>
                        </td>
                        <td>{{ $order->validity.Str::plural('year', $order->validity) }}</td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($order->discount_amount, 2, '.', ',')}}
                        </td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($order->final_amount, 2, '.', ',')}}
                        </td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($order->amount_paid, 2, '.', ',')}}
                        </td>
                        <td>
                            <b>
                                @if ($order->is_activated)
                                    <span class="text-success">Completed</span><br>
                                    <small class="text-muted">Activated on {{ date('d M, Y', strtotime($order->activated_at)) }}</small>
                                @else
                                    @if ($order->is_payment_confirmed)
                                        <span class="text-success">Paid</span><br>
                                        <small class="text-muted">Confirmed on {{ date('d M, Y', strtotime($order->payment_confirmed_at)) }}</small>
                                    @else
                                        <span class="text-danger">Unpaid</span><br>
                                        <small class="text-muted">Requested on {{ date('d M, Y', strtotime($order->created_at)) }}</small>
                                    @endif
                                @endif
                            </b>
                        </td>
                        <td class="text-end">
                            @if (!$order->is_activated)
                                <a href="{{ route('orders.edit', $order->id)}}" class="btn btn-sm btn-outline-primary mb-2"><i class="bi bi-pencil-fill"></i></a>
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