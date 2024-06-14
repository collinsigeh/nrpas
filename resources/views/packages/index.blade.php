@extends('dashboard_layout')

@section('title', 'Packages')

@section('content')
@include('inc.alert_messages')
<div class="row" id="admin_body">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Packages</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>

        <div class="text-end mb-3">
            <a href="{{ route('packages.create') }}" class="btn btn-sm btn-primary mb-2">New package</a>
        </div>

          <div class="table-responsive">
            <table
              id="example"
              class="table table-striped data-table"
              style="width: 100%; font-size: 12px; padding: 15px 0; color: #727272;"
            >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Validity</th>
                  <th>Price (@include('inc.currency_symbol'))</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->validity.Str::plural('year', $package->validity) }}</td>
                        <td>
                            @include('inc.currency_symbol')
                            {{ number_format($package->price, 2, '.')}}
                        </td>
                        <td>
                            <b>
                                @if ($package->is_active)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </b>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('packages.edit', $package->id)}}" class="btn btn-sm btn-outline-primary mb-2"><i class="bi bi-pencil-fill"></i></a>
                            @if ($package->orders->count() < 1)
                              <form action="{{ route('packages.destroy', $package->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger mb-2"><i class="bi bi-trash-fill"></i></button>
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