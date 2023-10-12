<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Today Restaurant Bookings</title>

    <style>
        table {

        }
        table thead {
            border-bottom: 1px solid #002C50;
        }
        table thead tr th {
            color: #002C50;
            text-align: left;
            width: 130px;
        }
        table tbody tr td {
            font-size: 14px;
            font-weight: 400;
            padding: .5rem;
            text-transform: uppercase;
            width: 130px;
        }
    </style>
</head>
<body>
    <table style="width: 100%; margin-bottom: 50px;">
        <tbody>
        <tr>
            <td style="width: 40%;">
                <img style="height: 75px; margin-bottom: 20px; width: auto;" src="{{ asset('logos/mash-tun-new-logo-main.jpg') }}">
                <ul style="list-style-type: none; margin-left: 0 ; padding-left: 0 !important;">
                    <li style="">
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
            </td>
            <td style="text-align: right; color: #002C50; width: 60%;">
                <h4>Todays Bookings - {{ now()->format('d/m/Y') }}</h4>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Joining for</th>
                <th>Time</th>
                <th>No of Guests</th>
                <th>Table</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todaysBookings as $booking)
                <tr>
                    <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                    <td>{{ $booking->joining_for }}</td>
                    <td>{{ $booking->reservation_time }}</td>
                    <td>{{ $booking->no_of_guests }}</td>
                    <td>
                        @foreach(json_decode($booking->table_ids) as $tableId)
                            Table {{ $tableId }}
                        @endforeach

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="display: block; font-weight: bold; font-size: 1rem; margin: 20px 0; text-align: center; width: 100%;">
        Printed {{ now()->format('d/m/Y H:i') }}
    </p>
</body>
</html>
