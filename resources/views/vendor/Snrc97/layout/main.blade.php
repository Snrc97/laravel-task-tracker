<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <title>
        {{ $title }}
    </title>
    <link href="{{ asset('vendor/Snrc97/css/site.css') }}" rel="stylesheet">

    @stack('links')
</head>

<body>
    <div class="container">
        @yield ('header')
        @stack('before-content')
        @yield ('content')
        @stack('after-content')
    </div>
    @yield ('footer')

    <script src="{{ asset('vendor/Snrc97/js/helper.js') }}"></script>

    @stack('scripts')

</body>

</html>
