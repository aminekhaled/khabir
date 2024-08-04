<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Al-Khabeer academy</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" />

        <!-- Bootstrap link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <style>
            * {
                font-family: cairo
            }
        </style>

        @vite('resources/css/app.css')

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

        <div id="app" >
            <router-view/>
        </div>
        @vite('resources/js/app.js')


        <script src='{{ asset("js/index.js") }}'></script>
        <script src='{{ asset("js/check-out.js") }}'></script>
        <script src='{{ asset("js/course-content.js") }}'></script>
        <script src='{{ asset("js/courses.js") }}'></script>
        <script src='{{ asset("js/general.js") }}'></script>
        <script src='{{ asset("js/login.js") }}'></script>
        <script src='{{ asset("js/profile.js") }}'></script>
        <script src='{{ asset("js/section-courses.js") }}'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



    </body>
</html>
