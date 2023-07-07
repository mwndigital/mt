<!doctype>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Contact form Submission Email</title>
    </head>
    <div>
        <div style="background-color: #fff; padding: 10px 0;">
            <img class="mainLogo" src="{{ asset('logos/main-logo.webp') }}" alt="Mash Tun Logo" style="display: block; height: 100px; margin: 20px auto; width: auto;">
        </div>
        <div style="display: block; margin: 0 auto; width: 75%;">
            <h1 style="text-align: center; margin-bottom: 30px; color:#002C50;">There's a new contact form submission</h1>
            <p style="display: block; margin: 20px 0;">
                {{ $contactFormSubmissions->name }} has sent you a message from a contact form on the website, the full details can be found below.
            </p>
            <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
                <li>
                    <strong>Name:</strong> {{ $contactFormSubmissions->name }}
                </li>
                <li>
                    <strong>Email:</strong> {{ $contactFormSubmissions->email }}
                </li>
                <li>
                    <strong>Message:</strong> {{ $contactFormSubmissions->yourMessage }}
                </li>
            </ul>
        </div>
    </div>
</html>
