<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    <title>DINSAL - Dashboard Informasi Satu Link</title>
</head>

<body>
    <div id="app">
        <div class="flex flex-row min-h-screen min-w-min">
            <div class="flex flex-col w-full">
                <div class="flex-1 bg-gray-200">
                    <router-view></router-view>
                </div>
                <footer-component></footer-component>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
