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
        
        <div class="flex flex-col md:flex-row justify-between items-center relative">
            <!-- Logo -->
            <div class="mt-6">
                <a href="/"><img src="/assets/images/site/logo.png" alt="wisener-logo" class="h-10"></a>
            </div>

            <!-- Nav Section -->
            <nav class="border border-zinc-100 rounded-full py-2 shadow w-max mx-auto mt-6">
                <ul class="flex justify-center text-sm space-x-4 px-4 items-center">
                    <li><a href="/" class="">Home</a></li>
                    <li><a href="/blog" class="">Blog</a></li>
                    <li><a href="/about" class="">About</a></li>

                    @if(Auth::check())
                        <!-- Dropdown Trigger -->
                        <li class="relative">
                            <button id="userMenuButton" class="flex items-center gap-1 focus:outline-none cursor-pointer">
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="userDropdown" class="absolute right-0 mt-4 w-30 bg-white border border-slate-200 translate-x-4 rounded-xl shadow-lg z-50 hidden">
                                <div class="">
                                    <a href="/profile/{{ Auth::user()->name_slug }}" class="block px-4 py-2 hover:bg-zinc-100">Profile</a>
                                    <a href="/support/" class="block px-4 py-2 hover:bg-zinc-100">Support</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-zinc-100 hover:text-teal-500 cursor-pointer">Logout</button>
                                        </form>
                                    @can('Admin')
                                        <a href="/admin" class="block px-4 py-2 hover:bg-zinc-100 text-orange-800 font-bold">Admin</a>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @else
                        <li><a href="/login" class="">Login</a></li>
                        <li><a href="/register" class="">Register</a></li>
                    @endif
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
    
    </body>
</html>
