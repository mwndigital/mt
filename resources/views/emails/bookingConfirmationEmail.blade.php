<!doctype>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your booking with The Mash Tun</title>
</head>
<div>
    <div style="background-color: #fff; padding: 10px 0;">
        <img class="mainLogo" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}" alt="Mash Tun Logo" style="display: block; height: 100px; margin: 20px auto; width: auto;">
    </div>
    <div style="display: block; margin: 0 auto; width: 75%;">
        <h1 style="text-align: center; margin-bottom: 30px; color:#002C50;">Your booking details</h1>
        <p style="display: block; margin: 20px 0; text-transform: capitalize;">
            Hello, {{ $booking->user_title }} {{ $booking->first_name }} {{ $booking->last_name }}
        </p>
        <p>
            Thank you for making a booking with us, the full details of your booking can be found below.
        </p>
        <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
            <li>
                <strong>Booking Reference:</strong> {{ $booking->booking_ref }}
            </li>
            <li>
                <strong>Arrival Date & Time</strong> {{ date('d/m/Y', strtotime($booking->checkin_date)) }} {{ $booking->arrival_time }}
            </li>
            <li>
                <strong>Checkout Date:</strong> {{ $booking->checkout_date }}
            </li>
            <li>
                <strong>Duration of stay:</strong> {{ $booking->duration_of_stay }} nights
            </li>
            <li>
                <strong>Your Room:</strong>
                @foreach ($booking->rooms as $room )
                    {{ $room->name }} <br>
                @endforeach
            </li>
            <li>
                <strong>Number of Adults:</strong> {{ $booking->no_of_adults }}
            </li>
            <li>
                <strong>Number of children:</strong> {{ $booking->no_of_children }}
            </li>
            <li>
                <strong>Phone Number:</strong> {{ $booking->phone_number }}
            </li>
            <li>
                <strong>Email Address:</strong> {{ $booking->email_address }}
            </li>
        </ul>
        <p style="display: block; margin: 20px 0;">
            Thank you for your booking and we look forward to seeing you when you arrive.
        </p>
    </div>
</div>
</html>
