<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your restaurant booking at The Mash Tun has been cancelled</title>

    <style>
        ul.socialWebsiteLinks {
            list-style-type: none;
            padding-bottom: 1rem;
            padding-top: 1rem;
            text-align: center;
        }
        ul.socialWebsiteLinks li {
            display: inline-block;
            width: 50px;
        }
    </style>
</head>
<div>
    <div style="background-color: #fff; padding: 10px 0;">
        <img class="mainLogo" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}" alt="Mash Tun Logo" style="display: block; height: 100px; margin: 20px auto; width: auto;">
    </div>
    <div style="display: block; margin: 0 auto; width: 75%;">
        <h1 style="text-align: center; margin-bottom: 30px; color:#002C50;">Booking Cancellation</h1>
        <p style="display: block; margin: 20px 0; text-transform: capitalize;">
            Hello, {{ $booking->first_name }} {{ $booking->last_name }}
        </p>
        <p style="display: block; margin: 20px 0;">
            Your booking with The Mash Tun has been cancelled.
        </p>
        <p style="display: block; margin: 20px 0;">
            We're sorry that you have cancelled your booking with us and we hope to see you again in the very near future.
        </p>
    </div>
    <div style="background-color: #002C50; display: block; margin: 40px auto 0 auto; width: 75%;">
        <ul class="socialWebsiteLinks">
            <li>
                <a href="https://www.tripadvisor.co.uk/Hotel_Review-g658240-d672367-Reviews-The_Mash_Tun-Aberlour_Moray_Scotland.html" rel="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/trip-advisor.png') }}" alt="TripAdvisor Icon">
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/themashtunaberlour/?locale=en_GB" rel="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/facebook.png') }}" alt="Facebook Icon">
                </a>
            </li>
            <li>
                <a href="https://twitter.com/MashTunAberlour" re="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/twitter.png') }}" alt="X/Twitter Icon">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/therealmashtunaberlour/?hl=en" rel="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/instagram.png') }}" alt="Instagram Icon">
                </a>
            </li>
            <li>
                <a href="https://restaurantguru.com/Mash-Tun-Aberlour" rel="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/restaurant-guru.png') }}" alt="Restaurant Guru Icon">
                </a>
            </li>
            <li>
                <a href="https://www.mashtun-aberlour.com/" rel="nofollow" target="_blank">
                    <img height="40" width="40" src="{{ asset('images/email/website.png') }}" alt="The Mash Tun Website logo">
                </a>
            </li>
        </ul>
    </div>
</div>
</html>
