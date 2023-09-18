@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 4 Payment | Aberlour Moray Scotland
@endpush
@push('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CVV number
        const cvvInput = document.getElementById('cvv');

        cvvInput.addEventListener('input', function(event) {
            let value = event.target.value.replace(/\D/g, '');

            if (value.length > 5) value = value.slice(0, 5);

            event.target.value = value;
        });

        // Card number
        const cardNumberInput = document.getElementById('card_number');

        cardNumberInput.addEventListener('input', function(event) {
            let value = event.target.value.replace(/\D/g, '');

            if (value.length > 4) {
                value = value.slice(0, 4) + '-' + value.slice(4);
            }
            if (value.length > 9) {
                value = value.slice(0, 9) + '-' + value.slice(9);
            }
            if (value.length > 14) {
                value = value.slice(0, 14) + '-' + value.slice(14);
            }

            event.target.value = value;
        });
    });
    </script>

@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 80%;
        }
    </style>
@endpush
@section('content')
    <section class="bookingPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Book a stay with us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 4</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-process-payment') }}">
                            @csrf
                            <h4 class="stepTitle">Payment</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="cardName">Name on Card</label>
                                    <input type="text" id="cardName" name="name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Card Number *</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="Card Number" required>
                                    @error('card_number')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <input type="text" name="card[state]" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Expiry Month</label>
                                    <select name="expiry_month" id="card_expiry_month" required>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    @error('card_expiry_month')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Expiry Year</label>
                                    <select name="expiry_year" id="card_expiry_year" required>
                                        @php
                                            $currentYear = date('Y');
                                            $futureYear = $currentYear + 10; // Replace 10 with the number of years you want to display in the future
                                        @endphp
                                        @for ($year = $currentYear; $year <= $futureYear; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('card_expiry_year')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">CVV</label>
                                    <input type="text" name="cvv" id="cvv" placeholder="CVV" required>
                                    {{-- <input type="text" name="card[state]" id="card_state" value=" " style="display: none;"> --}}
                                </div>
                            </div>




                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-2') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class='nextBtn'>Next <i class="fas fa-chevron-right"></i></button>
                                    {{--<a href="{{ route('book-a-room-payment-step') }}" class="nextBtn">Continue To Payment <i class="fas fa-chevron-right"></i></a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
