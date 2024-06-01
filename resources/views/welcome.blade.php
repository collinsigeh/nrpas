@extends('web_layout')

@section('title', 'NCAA Rpas Nigeria')

@section('content')
    <div id="my-hero">
        <div style="height: 140px;"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-none d-md-block">
                        <div id="welcome">Welcome to Nigeria</div>
                        <div id="title">Remotely Piloted Aircraft Systems Registration Service</div>
                    </div>
                    <div class="d-block d-md-none">
                        <div id="welcome-mobile">Welcome to Nigeria</div>
                        <div id="title-mobile">Remotely Piloted Aircraft Systems Registration Service</div>
                    </div>
                    <div id="buttons">
                        <a href="{{ route('register') }}" class="web-button-white">Register My Drone</a>
                        <a href="{{ route('page.learn_more') }}" class="web-button-blue">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sub-hero">
        <div class="container text-center">
            <h2 class="my-custom-title sub-title d-none d-md-block">Do I need to Register my Remotely Piloted Aircraft?</h2>
            <h2 class="my-custom-title sub-title-mobile d-block d-md-none">Do I need to Register my Remotely Piloted Aircraft?</h2>
            <p class="sub-text d-none d-md-block">You need to register your aircraft if it weighs between 250 grams (0.55 lbs.) and up to 25 kg (55 lbs.)</p>
            <p class="sub-text-mobile d-block d-md-none">You need to register your aircraft if it weighs between 250 grams (0.55 lbs.) and up to 25 kg (55 lbs.)</p>
            <img src="/images/droneweight.png" alt="" style="width: 70%; max-width: 600px; padding: 20px 0">
            <div class="py-2">
                
            <p style="font-size: 21px; width: 70%; margin: auto;">You will be subject to civil and criminal penalties if you meet the criteria to register an unmanned aircraft and do not register.</p>
            </div>
            <div class="py-4"><a href="{{ route('register') }}" class="web-button-blue">Register My Drone</a></div>
        </div>
    </div>
    <div class="container">
        <div id="sub-hero2">
            <h2 class="my-custom-title sub-title d-none d-md-block">You must use the paper application or visit rpas.ncaa.gov.ng for registration process if:</h2>
            <h2 class="my-custom-title sub-title-mobile d-block d-md-none">You must use the paper application or visit rpas.ncaa.gov.ng for registration process if:</h2>
            <ul class="page-text d-none d-md-block">
                <li>Your Remotely Piloted Aircraft is 25 kg or greater</li>
                <li>You want ROC license for your operation</li>
                <li>You want to qualify a Remotely Piloted Aircraft for operation outside Nigeria</li>
                <li>You hold foreign ROC license</li>
                <li>The owner uses locally made Remotely Piloted Aircraft</li>
            </ul>
            <ul class="page-text-mobile d-block d-md-none">
                <li>Your Remotely Piloted Aircraft is 25 kg or greater</li>
                <li>You want ROC license for your operation</li>
                <li>You want to qualify a Remotely Piloted Aircraft for operation outside Nigeria</li>
                <li>You hold foreign ROC license</li>
                <li>The owner uses locally made Remotely Piloted Aircraft</li>
            </ul>
            <div class="text-center py-4">
                <a href="/content/pdf/Form_AC-GAD001.pdf" class="web-link">Click to Download Paper Application</a>
            </div>
        </div>
        <div id="privacy">
            <hr class="mb-4">
            <h2 class="my-custom-title text-center py-4">PRIVACY ACT STATEMENT</h2>
            <p>
                The authority for collecting personally identifiable information (PII) through the Remotely Piloted Aircraft Registration Service website which require aircraft to be registered as a condition of operation and establish the requirements for registration and registration processes. The principal purpose for which information collected is intended to be used is to complete the aircraft registration process and identify the aircraft to its owner. The failure to provide the required information will prevent the NCAA from registering your aircraft which is required to be completed prior to operation of the aircraft.
            </p>
        </div>
    </div>
@endsection