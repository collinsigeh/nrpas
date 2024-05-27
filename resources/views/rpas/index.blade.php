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
                  <th>Manufacturer</th>
                  <th>Serial No.</th>
                  <th>Model No.</th>
                  <th>Certificate No.</th>
                  <th>Nickname</th>
                  <th>Owner</th>
                  <th>Date Registered</th>
                </tr>
              </thead>
              <tbody>
                @foreach (Auth::user()->rpases as $rpas)
                    <tr>
                    <td>{{ $rpas->manufacturer }}</td>
                    <td>{{ $rpas->serial_no}}</td>
                    <td>{{ $rpas->model_no}}</td>
                    <td><a href="{{ route('rpas.certificate', $rpas->id)}}" class="my_custom_table_link" title="Click to view certificate">{{ $rpas->cert_no}}</a></td>
                    <td>{{ $rpas->nickname}}</td>
                    <td>
                        @if ($rpas->user->profile->org_name)
                            {{ $rpas->user->profile->org_name }}
                        @else
                            {{ $rpas->user->firstname.' '. $rpas->user->lastname }}
                        @endif
                    </td>
                    <td>{{ $rpas->registered_at }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

    </div>
</div>
@endsection