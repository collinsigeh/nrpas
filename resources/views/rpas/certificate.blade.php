@extends('web_layout')

@section('title', 'RPAS (drone) Certificate No. '.$rpas->id)

@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="my-custom-title">{{ $rpas->cert_no }}</h1>

            @include('inc.alert_messages')

            <div id="certToPrint">
                bla bla bla. cert things!
            </div>

            <div class="mt-4">
                <button class="my-custom-primary-button" onclick="printCertificate">Print</button>
            </div>
        </div>
    </div>
@endsection