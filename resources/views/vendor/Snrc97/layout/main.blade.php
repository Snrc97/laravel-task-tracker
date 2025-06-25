<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <title>
        {{ $title }}
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="{{ asset('vendor/Snrc97/css/site/main.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/Snrc97/css/datatable/main.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/Snrc97/css/modal/main.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ajax CDN (included with jQuery) -->

    <!-- DataTables CSS CDN -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">



    @stack('styles')
</head>

<body>
    <div class="progress-circle-container d-none">
        <img class="progress-circle" src="{{ asset('vendor/Snrc97/assets/img/progress-circle.gif') }}"/>
    </div>
    <div class="container">
        @yield ('header')
        @stack('before-content')
        @yield ('content')
        @stack('after-content')
    </div>
    @yield ('footer')

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS CDN -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('vendor/Snrc97/js/ajax.js') }}"></script>

    <script src="{{ asset('vendor/Snrc97/js/datatable.js') }}"></script>


    <script src="{{ asset('vendor/Snrc97/js/helper.js') }}"></script>


    @stack('scripts')

    @stack('modals')


</body>

</html>
@php
@endphp