<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@stack('page-title') - {{ config('app.name', 'Laravel') }}</title>

        <!-- Meta -->
        <meta name="description" content="@stack('page-description')">
        <meta name="keywords" content="@stack('page-keywords')">

        <link rel="canonical" href="{{ config('configurations.app_url', config('app.url')) }}/@stack('page-slug')">

        <!-- Open Graph Stuff -->
        <meta property="og:title" content="@stack('page-title')">
        <meta property="og:description" content="@stack('page-description')">
        <meta property="og:url" content="{{ config('configurations.app_url', config('app.url')) }}/@stack('page-slug')">
        <meta property="og:type" content="@stack('page-type')">
        <meta property="og:site_name" content="{{ config('configurations.app_name', config('app.name')) }}">
        <meta property="og:image" content="@stack('page-image')"/>
        <meta property="og:locale" content="en_GB">

        <!-- styles -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        @vite(['resources/assets/sass/app.scss', 'resources/assets/sass/frontend.scss', 'resources/assets/js/app.js', 'resources/assets/js/frontend.js'])

        @stack('page-styles')

        @stack('page-scripts')

    </head>
    <body>
        <header>
            @include('frontend.layouts.partials.topBar')
            @include('frontend.layouts.partials.mainMenu')
        </header>
        @include('sweetalert::alert')
        <main>
