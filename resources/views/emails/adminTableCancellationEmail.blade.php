<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A table booking has been cancelled</title>
</head>
<div>
    <div style="background-color: #fff; padding: 10px 0;">
        <img class="mainLogo" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}" alt="Mash Tun Logo" style="display: block; height: 100px; margin: 20px auto; width: auto;">
    </div>
    <div style="display: block; margin: 0 auto; width: 75%;">
        <h1 style="text-align: center; margin-bottom: 30px; color:#002C50;">Booking Cancellation</h1>
        <p style="display: block; margin: 20px 0; text-transform: capitalize;">
            Hello
        </p>
        <p>
            A table booking from {{ $booking->first_name }} {{ $booking->last_name }} has been cancelled.  The full details of the booking can be found below.
        </p>
        <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
            <li>
                <strong>Joining us for:</strong> {{ $booking->joining_for }}
            </li>
            <li>
                <strong>Date:</strong> {{ date('d/m/Y', strtotime($booking->reservation_date)) }}
            </li>
            <li>
                <strong>Start time:</strong> {{ $booking->reservation_time }}
            </li>
            <li>
                <strong>Number of guests:</strong> {{ $booking->no_of_guests }}
            </li>
            {{--<li>
                <strong>Your email address:</strong> {{ $table_booking->email }}
            </li>--}}
        </ul>
    </div>
</div>
</html>
