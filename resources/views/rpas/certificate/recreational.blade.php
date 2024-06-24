@extends('dashboard_layout')

@section('title', 'RPAS (Drone) Certificate')

@section('content')
<div class="container" id="main-body">
  <div style="height: 20px;"></div>
  <div class="row">
      <div class="col-12">
          <h1 class="my-custom-title text-center pb-4">Recreational certificate</h1>

          @include('inc.alert_messages')
          
          <div class="row">
              <div class="col-md-6">
                  <div style="width: 100%;
                      border-radius: 18px; 
                      padding: 20px;
                      background: url(/images/certificate-bg-3.png);
                      background-size: cover;
                      background-repeat: no-repeat;
                      background-position: right bottom;
                      margin-bottom: 30px;">
                      <div class="text-center">
                          <img src="/images/ncaa-logo-2.png" alt="" style="width: 50%;">
                      </div>
                      <div class="text-center" style="font-size: 32px; color: #28156e; font-weight: 700; margin-bottom: 20px;">
                          RPAS Certificate of Registration
                      </div>
                      <div class="text-white">
                          <div style="font-size: 19px; margin-bottom: 10px;">
                              Certificate Holder: <b>
                                {{ $rpas->user->profile->firstname.' '.$rpas->user->profile->lastname }}
                              </b>
                          </div>
                          <div style="font-size: 19px; margin-bottom: 10px;">
                              RPAS Certificate Number: <b>{{ $rpas->cert_no }}</b>
                          </div>
                          <div style="font-size: 19px; margin-bottom: 10px;">
                              Date Issued: <b>{{ date('d-m-Y', strtotime($rpas->user->registered_at)) }}</b>
                          </div>
                          <div style="font-size: 19px; margin-bottom: 10px;">
                              Certificate Expiration Date: <b>{{ date('d-m-Y', $certificate_expiration) }}</b>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div style="width: 100%; 
                      border-radius: 18px; 
                      padding: 20px;
                      background: url(/images/certificate-bg-3.png);
                      background-size: cover;
                      background-repeat: no-repeat;
                      background-position: right bottom;
                      color: #28156e;
                      font-size: 13px;
                      margin-bottom: 30px;">
                      <p>
                          For Nigerian. citizens, permanent residents, and certain non-citizen Nigerian. corporations, this document constitutes a Certificate of Registration. For all others, this document represents a recognition of ownership.
                      </p>
                      <p>
                          For all holders, for all operations other than as a model aircraft additional safety authority from NCAA and other authority may be required.
                      </p>
                      <div class="text-center pb-2" style="color: #000; font-size: 21px;">
                          Safety Guideline for flying you Remotely Piloted Aircraft:
                      </div>
                      <div class="row">
                          <div class="col-5">
                              <ul>
                                  <li>
                                      Fly below 400 feet
                                  </li>
                                  <li>
                                      Never fly near other aircraft
                                  </li>
                                  <li>
                                      Keep your RPA within line of sight
                                  </li>
                                  <li>
                                      Keep away from emergency responders
                                  </li>
                              </ul>
                          </div>
                          <div class="col-7">
                              <ul>
                                  <li>
                                      Never Fly over stadiums, sports events or groups of people
                                  </li>
                                  <li>
                                      Never fly under the influence of drug or alcohol
                                  </li>
                                  <li>
                                      Never fly within 5 mile of an airport without first contacting air traffic control and airport authorities
                                  </li>
                              </ul>
                          </div>
                      </div>
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
                          <img src="/images/certificate-bg-3.png" alt="" style="width: 100%; border-radius: 18px;">
                          <table style="width: 100%; margin-top: -480px;">
                              <tr>
                                  <td colspan="2" style="text-align: center">
                                      <img src="/images/ncaa-logo-2.png" alt="" width="350px;">
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="2" style="padding-bottom: 20px; text-align: center; font-size: 42px; color: #28156e;">
                                      RPAS Certificate of Registration
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px; color: #fff;">Certificate Holder:</td>
                                  <td style="font-size: 27px; color: #fff;">
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
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px; color: #fff;">RPAS Certificate Number:</td>
                                  <td style="font-size: 27px; color: #fff;">
                                      <b>
                                          {{ $rpas->cert_no }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px; color: #fff;">Date Issued:</td>
                                  <td style="font-size: 27px; color: #fff;">
                                      <b>
                                          {{ date('d-m-Y', strtotime($rpas->user->registered_at)) }}
                                      </b>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 300px; height: 50px; padding-left: 20px; font-size: 24px; color: #fff;">Certificate Expiration Date:</td>
                                  <td style="font-size: 27px; color: #fff;">
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
                          <img src="/images/certificate-bg-3.png" alt="" style="width: 100%; border-radius: 18px;">
                          <table style="width: 100%; margin-top: -480px;">
                              <tr>
                                  <td style="padding: 30px 30px 0 30px; font-size: 18px; color: #28156e;">
                                      <p>
                                          For Nigerian. citizens, permanent residents, and certain non-citizen Nigerian. corporations, this document constitutes a Certificate of Registration. For all others, this document represents a recognition of ownership. 
                                      </p>
                                      <p>
                                          For all holders, for all operations other than as a model aircraft additional safety authority from NCAA and other authority may be required.
                                      </p>
                                      <div style="text-align: center; font-size: 24px; color: #000; padding: 30px;">
                                          Safety Guideline for flying you Remotely Piloted Aircraft: 
                                      </div>
                                      <table>
                                          <tr>
                                              <td style="font-size: 18px; color: #28156e;">
                                                  <ul>
                                                      <li>
                                                          Fly below 400 feet 
                                                      </li>
                                                      <li>
                                                          Never fly near other aircraft 
                                                      </li>
                                                      <li>
                                                          Keep your RPA within line of sight 
                                                      </li>
                                                      <li>
                                                          Keep away from emergency responders 
                                                      </li>
                                                  </ul>
                                              </td>
                                              <td style="font-size: 18px; color: #28156e;">
                                                  <ul>
                                                      <li>
                                                          Never Fly over stadiums, sports events or groups of people 
                                                      </li>
                                                      <li>
                                                          Never fly under the influence of drug or alcohol 
                                                      </li>
                                                      <li>
                                                          Never fly within 5 mile of an airport without first contacting air traffic control and airport authorities 
                                                      </li>
                                                  </ul>
                                              </td>
                                          </tr>
                                      </table>
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