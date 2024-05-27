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
              style="width: 100%; font-size: 14px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
            </table>
          </div>

    </div>
</div>
@endsection