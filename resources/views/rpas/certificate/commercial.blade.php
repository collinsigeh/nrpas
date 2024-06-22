@extends('web_layout')

@section('title', 'RPAS (Drone) Certificate')

@section('content')
<div class="container" id="main-body">
  <div style="height: 140px;"></div>
  <div class="row">
      <div class="col-12">
          <h1 class="my-custom-title text-center pb-4">Commercial certificate</h1>

          @include('inc.alert_messages')
          
          <div class="row">
              <div class="col-md-6">
                  <div style="width: 100%; 
                      border: 5px solid #28156E; 
                      border-radius: 18px; 
                      padding: 20px;
                      background: url(/images/certificate-bg-2.png);
                      background-size: cover;
                      background-repeat: no-repeat;
                      background-position: right bottom;
                      margin-bottom: 30px;">
                      <div class="text-center" style="font-size: 32px; color: #28156e; font-weight: 700; margin-bottom: 20px;">
                          RPAS Certificate of Registration
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Certificate Holder: <b>
                              
                              @if ($rpas->user->profile->org_name)
                                  {{ $rpas->user->profile->org_name }}
                              @else
                                  {{ $rpas->user->profile->firstname.' '.$rpas->user->profile->lastname }}
                              @endif
                          </b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Manufacturer: <b>{{ $rpas->manufacturer }}</b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Model: <b>{{ $rpas->model_no }}</b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Serial Number: <b>{{ $rpas->serial_no }}</b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Certificate Number: <b>{{ $rpas->cert_no }}</b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Date Issued: <b>{{ date('d-m-Y', strtotime($rpas->user->registered_at)) }}</b>
                      </div>
                      <div style="font-size: 19px; margin-bottom: 10px;">
                          Certificate Expiration Date: <b>{{ date('d-m-Y', $certificate_expiration) }}</b>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div style="width: 100%; 
                      border: 5px solid #28156E; 
                      border-radius: 18px; 
                      padding: 20px;
                      background: url(/images/certificate-bg-2.png);
                      background-size: cover;
                      background-repeat: no-repeat;
                      background-position: right bottom;
                      color: #28156e;
                      font-size: 13px;
                      margin-bottom: 30px;">
                      <p>
                          For Nigerian citizens, permanent residents, and certain non-citizen Nigerian. corporations, this document constitutes a Certificate of Registration. For all others, this document represents a recognition of ownership.
                      </p>
                      <p>
                          For all holders, for all operations other than as a model aircraft additional safety authority from NCAA and other authority may be required.
                      </p>
                      <p>
                          This RPA Certificate of Registration is not an authorization to conduct flight operations with an unmanned aircraft. Operations must be conducted in accordance with the applicable NCAA requirements. The operator of the aircraft is responsible for knowing and understanding what those requirements are. For more information on flying for non-model purposes, please visit the NCAA website at www.rpas.ncaa.gov.ng
                      </p>
                      <img src="/images/authority-logos.png" alt="" style="width: 80%;">
                  </div>
                  
              </div>
          </div>

          <div class="pt-2">
              <button class="my-custom-primary-button" onclick="printCertificate()">Print</button>
          </div>
          
          <div id="certToPrint">
              <table style="margin: 50px auto 10px auto;">
                  <tr>
                      <td style="width: 800px;">
                          <img src="/images/certificate-bg-2.png" alt="" style="width: 100%; border: 5px solid #28156E; border-radius: 18px;">
                          <table style="width: 100%; margin-top: -480px;">
                              <tr>
                                  <td colspan="2" style="padding-bottom: 20px; text-align: center; font-size: 42px; color: #28156e;">
                                      RPAS Certificate of Registration
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Certificate Holder:</td>
                                  <td style="font-size: 27px;;">
                                      <b>
                                          @if ($rpas->user->profile->org_name)
                                              {{ $rpas->user->profile->org_name }}
                                          @else
                                              {{ $rpas->user->profile->firstname.' '.$rpas->user->profile->lastname }}
                                          @endif
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Manufacturer:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ $rpas->manufacturer }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Model:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ $rpas->model_no }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Serial Number:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ $rpas->serial_no }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Certificate Number:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ $rpas->cert_no }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Date Issued:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ date('d-m-Y', strtotime($rpas->user->registered_at)) }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px;">Certificate Expiration Date:</td>
                                  <td style="font-size: 27px;">
                                      <b>
                                          {{ date('d-m-Y', $certificate_expiration) }}
                                      </b>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>
              
              <table style="margin: 80px auto 10px auto;">
                  <tr>
                      <td style="width: 800px;">
                          <img src="/images/certificate-bg-2.png" alt="" style="width: 100%; border: 5px solid #28156E; border-radius: 18px;">
                          <table style="width: 100%; margin-top: -480px;">
                              <tr>
                                  <td style="padding: 0 30px; font-size: 18px; color: #28156e;">
                                      <p>
                                          For Nigerian citizens, permanent residents, and certain non-citizen Nigerian. corporations, this document constitutes a Certificate of Registration. For all others, this document represents a recognition of ownership.
                                      </p>
                                      <p>
                                          For all holders, for all operations other than as a model aircraft additional safety authority from NCAA and other authority may be required.
                                      </p>
                                      <p>
                                          This RPA Certificate of Registration is not an authorization to conduct flight operations with an unmanned aircraft. Operations must be conducted in accordance with the applicable NCAA requirements. The operator of the aircraft is responsible for knowing and understanding what those requirements are. For more information on flying for non-model purposes, please visit the NCAA website at www.rpas.ncaa.gov.ng
                                      </p>
                                      <img src="/images/authority-logos.png" alt="" style="width: 720px;">
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection