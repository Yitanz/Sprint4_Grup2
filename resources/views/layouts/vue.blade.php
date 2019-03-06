<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>COSES</title>

</head>
<body>
    <div id="app">
        @yield("content")
    </div>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
