@extends('web_layout')

@section('title', 'Safety Agreement')

@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="my-custom-title">Acknowledgment of Safety Guidance</h1>

            @include('inc.alert_messages')

            <form action="{{ route('login.post') }}" method="post" class="mt-4" id="safety-form">
                @csrf

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-fly-below-400-feet" value="1" id="part1" required>
                    <label class="form-check-label" for="part1">
                        I will fly below 400 feet
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-fly-within-visual-line-of-sight" value="1" id="part2" required>
                    <label class="form-check-label" for="part2">
                        I will fly within visual line of sight
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-be-aware-of-NCAA-airspace-requirements" value="1" id="part3" required>
                    <label class="form-check-label" for="part3">
                        I will be aware of NCAA airspace requirements
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-not-fly-directly-over-people" value="1" id="part4" required>
                    <label class="form-check-label" for="part4">
                        I will <b>not</b> fly directly over people
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-not-fly-directly-over-stadiums-and-sports-events" value="1" id="part5" required>
                    <label class="form-check-label" for="part5">
                        I will <b>not</b> fly directly over stadiums and sports events
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-not-fly-near-emergency-response-efforts-such-as-fires" value="1" id="part6" required>
                    <label class="form-check-label" for="part6">
                        I will <b>not</b> fly near emergency response efforts such as fires
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-not-fly-near-aircrafts-especially-near-airports" value="1" id="part7" required>
                    <label class="form-check-label" for="part7">
                        I will <b>not</b> fly near aircrafts, especially near airports
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="I-will-not-fly-under-the-influence" value="1" id="part8" required>
                    <label class="form-check-label" for="part8">
                        I will <b>not</b> fly under the influence
                    </label>
                </div>
                
                <div class="mt-4">
                    <a href="{{route('register')}}" class="my-custom-secondary-web-button">Don't Agree</a>
                    <a href="{{route('login')}}" class="my-custom-primary-web-button">Agree</a>
                </div>
            </form>
        </div>
    </div>
@endsection