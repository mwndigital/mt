@extends('layouts.frontend')
@push('page-title')
    Contact us
@endpush
@section('content')
    <section id="contactPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/contact-page-hero.jpg') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contactPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Find Us</h2>
                    <ul class="list-unstyled address">
                        <li>
                            The Mash Tun,
                        </li>
                        <li>
                            8 Broomfield Square,
                        </li>
                        <li>
                            Arberlour, Speyside,
                        </li>
                        <li>Scotland,</li>
                        <li>AB38 9QP</li>
                    </ul>
                    <ul class="list-unstyled contactDetails">
                        <li>
                            Tel: <a href="tel:+441340881771">01340 881771</a>
                        </li>
                        <li>
                            Email: <a href="mailto:reservations@mashtun-aberlour.com">reservations@mashtun-aberlour.com</a>
                        </li>
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><img class="img-fluid tripAdvisorLogo" src="{{ asset('logos/trip-advisor.svg') }}" alt="TripAdvisor Logo"></a></li>
                        <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Send us a message</h2>
                    <div class="formWrap">
                        <form action="{{ route('contact-us-submission-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Email Address *</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Your Message *</label>
                                    <textarea name="yourMessage" id="yourMessage" cols="30" rows="10" required>{{ old('yourMessage') }}</textarea>
                                    @error('yourMessage')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="blueBtn">
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contactUsPageMap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2145.4462992921463!2d-3.2299177231644216!3d57.47073455838124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4885a463316eb097%3A0x886cde74855c98a!2sThe%20Mash%20Tun!5e0!3m2!1sen!2suk!4v1688463099736!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection
