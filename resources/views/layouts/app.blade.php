<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">
        <link rel="mask-icon" href="{{ asset('/assets/images/site/logo.png') }}" color="#5bbad5">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="author" content="Lee Wisener">
        <meta name="keywords" content="Mortgages, BTL, Lifetime, Rent, Borrowing, Inflation, CeMAP, CeRER">
        <title>{{ $page->title ?? 'Wisener.net' }}</title>
        <meta name="description" content="{{ $page->summary ?? 'Mortgages - A Personal mortgage blog dedicated to all aspects of mortgage lending in the UK.' }}">

        @isset($page)
        <!-- Twitter Meta -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@wisenerl" />
        <meta name="twitter:title" content="{{ $page->title }}" />
        <meta name="twitter:description" content="{{ $page->pagesummary }}" />
        <meta name="twitter:image" content="{{ asset($page->small_image) }}" />
    
        <!-- Open Graph Meta -->
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ $page->title }}" />
        <meta property="og:description" content="{{ $page->pagesummary }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ asset($page->small_image) }}" />
        @endisset

        <!-- moved this to the top due to FOUC -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/images/site/logo.png') }}">

        <title>{{ config('app.name', 'TheHolocaust') }}</title>

        <!-- FontAwesome -->
        <script async src="https://kit.fontawesome.com/0ff5084395.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Venobox css -->
        <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}" type="text/css" media="screen" />
        <script type="text/javascript" src="{{ asset('assets/js/venobox.min.js') }}"></script>

    </head>
    <body class="bg-zinc-50 min-h-screen">

    <!-- Open Outer Container -->
    <div class="max-w-screen-xl mx-auto bg-white shadow-sm px-4 sm:px-10 lg:px-20 min-h-screen flex flex-col">

        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="mt-6">
                <a href="/"><img src="../assets/images/site/logo.png" alt="wisener-logo" class="h-10"></a>
            </div>
            <!-- Nav Section -->
            <nav class="border border-zinc-100 rounded-full py-2 shadow w-max mx-auto mt-6">
                <ul class="flex justify-center text-sm space-x-4 px-4">
                    <li><a href="/" class="">Home</a></li>
                    <li><a href="/blog" class="">Blog</a></li>
                    <li><a href="/about" class="">About</a></li>
                     @can('Admin')
                        <li class="text-orange-800 font-bold"><a href="/about" class="">Admin</a></li>
                    @endcan
                </ul>
            </nav>
        </div> 

        <!-- Content Section -->
        <div class="flex-grow mt-10">
            @yield('content')
        </div>


        <!-- Footer -->
        <footer class="border-t border-zinc-200">
            <div class="text-sm text-center my-6">
                <p class="text-zinc-400">Copyright 2025, <span class=""><a href="https://wisener.net">wisener.net</a></span></p>
            </div>
        </footer>
        
    <!-- Close outer container -->
    </div>


        <!-- jQuery (Add it before other scripts update to 3.6.4) -->
        <link rel="preload" href="https://code.jquery.com/jquery-3.6.0.min.js" as="script">
    </body>
</html>
