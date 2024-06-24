@extends('web_layout')

@section('title', 'RPAS Certificate Verification')

@section('content')
<div class="container" id="main-body">
    <div style="height: 140px;"></div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="verified_cert">
                @if ($rpas)
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
                        <div class="status">
                            <span class="text-success">Active</span>
                        </div>
                        <div class="message">
                            The specified certificate with no: <b>{{ $search_parameter }}</b> is active!
                        </div>
                    @else
                        <div class="status">
                            <span class="text-danger">Expired</span>
                        </div>
                        <div class="message">
                            The specified certificate with no: <b>{{ $search_parameter }}</b> has expired!
                        </div>
                    @endif
                    <div class="cert_summary">
                        <div style="border-bottom: 1px dotted #c5c5c5; margin-bottom: 15px;">
                            Certificate information:
                        </div>
                        <small>
                            <div class="py-2">
                                <small class="text-muted">Certificate holder:</small><br>
                                @if ($rpas->user->acc_type == 'C' && $rpas->user->profile->org_name)
                                    {{ $rpas->user->profile->org_name }}
                                @else
                                    {{ $rpas->user->profile->firstname.' '.$rpas->user->profile->lastname }}
                                @endif
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Manufacturer:</small><br>
                                {{ $rpas->manufacturer}}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Model:</small><br>
                                {{ $rpas->model_no }}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Serial no:</small><br>
                                {{ $rpas->serial_no }}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Certificate no:</small><br>
                                {{ $rpas->cert_no }}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Certificate type:</small><br>
                                @if ($rpas->user->acc_type == 'R')
                                    Recreational
                                @elseif ($rpas->user->acc_type == 'C')
                                    Commercial
                                @endif
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Registered by:</small><br>
                                {{ $rpas->user->profile->firstname.' '.$rpas->user->profile->lastname.' ('.$rpas->user->email.')' }}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Validity:</small><br>
                                {{ $rpas->user->validity.' '.Str::plural('year', $rpas->user->validity) }}
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Issued date:</small><br>
                                <small><i>{{ date('d M, Y', strtotime($rpas->user->registered_at)) }}</i></small>
                            </div>
                            <div class="py-2">
                                <small class="text-muted">Expiration date:</small><br>
                                <small><i>{{ date('d M, Y', strtotime($rpas->user->registered_at) + ($rpas->user->validity * 365 * 24 * 60 * 60)) }}</i></small>
                            </div>
                        </small>
                        <div class="pt-4 text-center">
                            <a href="{{ route('certificate.verification')}}" class="btn btn-sm btn-primary"><i class="bi bi-arrow-left-short mr-2"></i>Back</a>
                        </div>
                    </div>
                @elseif ($search_parameter)
                    <div class="status">
                        <span class="text-danger">NOT Found</span>
                    </div>
                    <div class="message">
                        The specified certificate with no: <b>{{ $search_parameter }}</b> was not found!
                    </div>
                    <div class="pt-4 text-center">
                        <a href="{{ route('certificate.verification')}}" class="btn btn-sm btn-primary"><i class="bi bi-arrow-left-short mr-2"></i>Back</a>
                    </div>

                @else
                <h1 class="my-custom-title text-center mb-4">
                    RPAS Certificate Verification
                </h1>
                <form method="get" class="small-form shadow" style="
                    border: 1px solid #dbdbdb;
                    border-radius: 8px;
                    background-color: #f9f9f9;
                    padding: 30px 20px 20px 20px;
                    ">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="cert_no" class="pb-2">Certificate number:</label>
                        <input type="text" id="cert_no" class="form-control" placeholder="e.g. NRPAS/CERT/123" name="cert_id" value="" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Verify" class="my-custom-primary-web-button" style="font-size: 18px;">
                    </div>
                </form>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection