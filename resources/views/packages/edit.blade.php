@extends('dashboard_layout')

@section('title', 'New package')

@section('content')
@include('inc.alert_messages')
<div class="row">
    <div class="col-md-12 px-4 py-3">

        <h2 class="my-custom-title mb-3">Edit package</h2>

        <div style="border-top: 1px dotted #333; height: 20px;"></div>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="bg-light p-4">
                    <form action="{{ route('packages.update', $package->id) }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $package->name }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="validity">Validity (Years)</label>
                            <input type="number" id="validity" name="validity" class="form-control" value="{{ $package->validity }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="price">Price (@include('inc.currency_symbol'))</label>
                            <input type="number" id="price" name="price" class="form-control" value="{{ $package->price }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active"@if ($package->is_active == 1)
                                        selected
                                    @endif>Active</option>
                                <option value="Inactive"@if ($package->is_active != 1)
                                        selected
                                    @endif>Inactive</option>
                            </select>
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