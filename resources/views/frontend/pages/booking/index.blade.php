@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 1 | Aberlour Moray Scotland
@endpush
@push('page-styles')
    @viteReactRefresh
    @vite('resources/components/BookingForm.jsx')
@endpush
@push('page-scripts')
    <script>
        $(document).ready(function () {
            // Function to toggle visibility of adult and children inputs
            function toggleGuestInputs() {
                var selectedType = $('#type').val();
                if (selectedType === 'room') {
                    $('#no_of_adults').closest('.col-md-6').show();
                    $('#no_of_children').closest('.col-md-6').show();
                    // Make col-md-4 type input
                    $('#type').closest('.col-md-12').removeClass('col-md-12').addClass('col-md-4');
                } else if (selectedType === 'lodge') {
                    $('#no_of_adults').closest('.col-md-6').hide();
                    $('#no_of_children').closest('.col-md-6').hide();
                }
            }

            // Call the function when the page loads
            toggleGuestInputs();

            // Listen for changes in the #type field
            $('#type').on('change', function () {
                toggleGuestInputs();
            });
        });
    </script>

@endpush
@section('content')
    <section class="bookingPageTop"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Book a stay with us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('booking_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected dates are already booked. Please choose different dates.
        </div>
    @endif


    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <h4 class="stepTitle">Booking Details</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 1</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-1-store') }}">
                            @csrf
                            <span id="booking-form"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
