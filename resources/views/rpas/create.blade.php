@extends('web_layout')

@section('title', 'Add New RPAS')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-custom-title">Add New RPAS</h1>
        </div>

        @include('inc.alert_messages')

        <form action="{{ route('rpas.store') }}" method="post" class="mt-4 small-form">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="mb-4">
                        <select name="rpas_type" class="form-select" required>
                            <option value="">SELECT RPAS TYPE</option>
                            @foreach ($rpastypes as $type)
                                <option value="{{ $type->id }}" @if (old('rpas_type') == $type->id) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="manufacturer" placeholder="MANUFACTURER (Enter a Manufacturer)" value="{{ old('manufacturer') }}" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="model_no" placeholder="MODEL NUMBER (Enter a Model)" value="{{ old('model_no') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <input type="text" name="serial_no" placeholder="SERIAL NUMBER (Enter a Serial Number)" value="{{ old('serial_no') }}" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="nickname" placeholder="NICKNAME (Enter a Nickname)" value="{{ old('nickname') }}" class="form-control" required>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <input type="reset" value="Reset" class="my-custom-secondary-web-button" style="font-size: 18px; padding: 8px 22px;">
                <input type="submit" value="Add RPAS" class="my-custom-primary-web-button" style="font-size: 18px; padding: 8px 22px;">
            </div>
        </form>
    </div>
@endsection