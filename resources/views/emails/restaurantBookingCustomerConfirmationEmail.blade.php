<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your restaurant booking confirmation with The Mash Tun</title>
</head>
<div>
    <div style="background-color: #fff; padding: 10px 0;">
        <img class="mainLogo" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}" alt="Mash Tun Logo" style="display: block; height: 100px; margin: 20px auto; width: auto;">
    </div>
    <div style="display: block; margin: 0 auto; width: 75%;">
        <h1 style="text-align: center; margin-bottom: 30px; color:#002C50;">Your booking details</h1>
        <p style="display: block; margin: 20px 0; text-transform: capitalize;">
            Hello, {{ $table_booking->first_name }} {{ $table_booking->last_name }}
        </p>
        <p>
            Thank you for making a reservation with us.  Full details can be found below.
        </p>
        <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
            <li>
                <strong>What you are joining us for:</strong> {{ $table_booking->joining_for }}
            </li>
            <li>
                <strong>Date:</strong> {{ date('d/m/Y', strtotime($table_booking->reservation_date)) }}
            </li>
            <li>
                <strong>Start time:</strong> {{ $table_booking->reservation_time }}
            </li>
            <li>
                <strong>Number of guests:</strong> {{ $table_booking->no_of_guests }}
            </li>
            <li>
                <strong>Your email address:</strong> {{ $table_booking->email }}
            </li>
        </ul>
        <p style="display: block; margin: 20px 0;">
            Thank you for your booking and we look forward to seeing you when you arrive.
        </p>

    </div>
</div>
</html>
