<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Overview') · Wisener Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell">
    <aside class="admin-sidebar">
        <a href="/admin" class="admin-brand">wisener<span>.</span><span class="admin-brand-suffix">net</span></a>
        <p class="admin-eyebrow">Administration</p>
        <nav aria-label="Admin navigation" class="admin-nav">
            @foreach ([['/admin', 'Overview', '01'], ['/admin/blog', 'Blog & categories', '02'], ['/admin/users', 'Users', '03'], ['/admin/support', 'Support', '04']] as [$href, $label, $number])
                @php($active = $href === '/admin' ? request()->is('admin') : (request()->is(ltrim($href, '/').'*') || ($href === '/admin/blog' && request()->is('blog/*')) || ($href === '/admin/users' && request()->is('profile/*')) || ($href === '/admin/support' && request()->is('support/*'))))
                <a href="{{ $href }}" class="{{ $active ? 'is-active' : '' }}" @if($active) aria-current="page" @endif><span>{{ $number }}</span>{{ $label }}</a>
            @endforeach
        </nav>
        <div class="admin-sidebar-bottom">
            <a href="/">View website <span aria-hidden="true">↗</span></a>
            <p>{{ auth()->user()->name }}<span>Administrator</span></p>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Sign out</button></form>
        </div>
    </aside>
    <div class="admin-workspace">
        <header class="admin-topbar"><span>Workspace <span class="admin-divider">/</span> @yield('title', 'Overview')</span><div class="admin-topbar-links"><a href="/">View site ↗</a><a href="/blog/create" class="admin-button">+ New post</a></div></header>
        <main class="admin-content">
            @foreach (['created', 'updated', 'deleted', 'status'] as $message)
                @if(session($message))<div class="admin-notice" role="status">{{ session($message) }}</div>@endif
            @endforeach
            @yield('content')
        </main>
        <footer class="admin-footer">Wisener.net <span>Your thoughts. Your space.</span></footer>
    </div>
</body>
</html>
