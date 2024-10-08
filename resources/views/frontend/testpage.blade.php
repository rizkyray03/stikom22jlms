<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard</title>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script src="https://kit.fontawesome.com/6170d94faf.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passion+One&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/video.css') }}">
    <script src="https://www.youtube.com/player_api"></script>



</head>

<body class="font-poppins bg-gray-vanilla dark:bg-gray-900">
    <div class="container flex flex-col h-full">
        @include('includes.header')
        <main class="flex border border-lg">
            @include('includes.sidebar')
            <article>
                @yield('content')
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum vitae ullam quisquam, illum
                    architecto ipsam corrupti aperiam quis minima tempore illo nemo, dolorum dolorem molestias at sit
                    laudantium! Delectus, sapiente.</p>
                @include('includes.footer')
            </article>
        </main>
    </div>
</body>

</html>
