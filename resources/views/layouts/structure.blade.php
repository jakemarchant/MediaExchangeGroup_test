<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cards | Media Exchange Group</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>

@yield('content')

</body>

<script src="{{ asset('js/app.js') }}"></script>
@livewireScripts

</html>
