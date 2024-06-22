@extends('dashboard_layout')

@section('title', 'Registered Rpas')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Registered RPAS</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>

          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%; font-size: 12px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>Nickname</th>
                  <th>Certificate No.</th>
                  <th>Certificate Status</th>
                  <th>Owner</th>
                  <th>Manufacturer</th>
                  <th>Serial No.</th>
                  <th>Model No.</th>
                  <th>Date Registered</th>
                </tr>
              </thead>
              <tbody>
                @foreach (Auth::user()->rpases as $rpas)
                    <tr>
                    <td>{{ $rpas->nickname}}</td>
                    <td><a href="{{ route('rpas.certificate', $rpas->id)}}" class="my_custom_table_link" title="Click to view certificate">{{ $rpas->cert_no}}</a></td>
                    <td>
                      @php
                          $total_days = $rpas->user->validity * 365;
                          $days_used = floor((time() - strtotime($rpas->user->registered_at)) / (24 * 60 * 60));
                          $days_remaining = $total_days - $days_used;
                          if($days_remaining < 0)
                          {
                              $days_remaining = 0;
                          }
                      @endphp
                      @if ($days_remaining > 0)
                          <span class="badge badge-pill bg-success text-white">Active</span>
                      @else
                          <span class="badge badge-pill bg-danger text-white">Expired</span>
                      @endif
                    </td>
                    <td>
                        @if ($rpas->user->profile->org_name)
                            {{ $rpas->user->profile->org_name }}
                        @else
                            {{ $rpas->user->firstname.' '. $rpas->user->lastname }}
                        @endif
                    </td>
                    <td>{{ $rpas->manufacturer }}</td>
                    <td>{{ $rpas->serial_no}}</td>
                    <td>{{ $rpas->model_no}}</td>
                    <td>{{ date('d M, Y', strtotime($rpas->registered_at)) }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

    </div>
</div>
@endsection