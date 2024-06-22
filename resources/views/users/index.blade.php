@extends('dashboard_layout')

@section('title', 'Users')

@section('content')
@include('inc.alert_messages')
<div class="row" id="admin_body">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Users</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>

          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%; font-size: 12px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>User</th>
                  <th>Reg no.</th>
                  <th>Acc. type</th>
                  <th>Profile</th>
                  <th>Active subscription</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->profile)
                                <b>{{ $user->profile->firstname.' '.$user->profile->lastname }}</b><br>
                            @endif
                            <small class="text-muted">{{ $user->email }}</small>
                        </td>
                        <td>
                            {{ $user->reg_no }}
                        </td>
                        <td>
                            @if ($user->acc_type == 'A')
                                Admin
                            @elseif ($user->acc_type == 'R')
                                Recreational
                            @elseif ($user->acc_type == 'C')
                                Commercial
                            @endif
                        </td>
                        <td>
                            @if ($user->profile_complete)
                                <span class="badge badge-pill bg-success text-white">Complete</span>
                            @else
                                <span class="badge badge-pill bg-danger text-white">Incomplete</span>
                            @endif
                        </td>
                        <td>
                            @if (!empty($user->registered_at) & $user->validity)
                                @php
                                    $total_days = $user->validity * 365;
                                    $days_used = floor((time() - strtotime($user->registered_at)) / (24 * 60 * 60));
                                    $days_remaining = $total_days - $days_used;
                                    if($days_remaining < 0)
                                    {
                                        $days_remaining = 0;
                                    }
                                @endphp
                                {{ $user->validity.' '.Str::plural('year', $user->validity) }} subscription
                                @if ($days_remaining > 0)
                                    <span class="badge badge-pill bg-success text-white">Active</span>
                                @else
                                    <span class="badge badge-pill bg-danger text-white">Expired</span>
                                @endif<br>
                                <b>
                                    <small class="text-muted">Activated on {{ date('d M, Y', strtotime($user->registered_at)) }}</small>
                                </b>
                            @endif
                        </td>
                        <td class="text-end">
                            
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

    </div>
</div>
@endsection