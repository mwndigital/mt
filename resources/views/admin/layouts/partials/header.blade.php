<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@stack('page-title') - {{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

        @vite(['resources/assets/sass/app.scss', 'resources/assets/sass/admin.scss', 'resources/assets/js/app.js', 'resources/assets/js/admin.js'])

        @stack('page-styles')

        <x-head.tinymce-config/>
        @stack('page-scripts')
    </head>
    <body>
    @include('admin.layouts.partials.menus.topbar')
    @include('sweetalert::alert')
    @include('admin.layouts.partials.sidebar')
    <main class="main">
        <div class="container-fluid">

