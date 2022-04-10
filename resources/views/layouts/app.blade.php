<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @if (App::environment('production'))
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-TCL8JJR');</script>
            <!-- End Google Tag Manager -->
        @endif

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link rel="icon" href="{{ asset('storage/images/favicon.png') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

        @stack('css')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        @if (App::environment('production'))
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCL8JJR"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        @endif

        <x-jet-banner />

        <div class="min-h-screen bg-cyan-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <h1 class="text-center text-5xl my-12 text-rose-100">
                        {{ $header }}
                    </h1>
                </header>
            @endif

            <!-- Page Content -->
            <main class="xl:w-9/12 lg:w-10/12 w-11/12 mx-auto">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('js')
    </body>
</html>
