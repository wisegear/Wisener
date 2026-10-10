@extends('layouts.admin')
@section('title', 'Overview')
@section('content')
<div class="admin-page-heading"><p class="admin-eyebrow">At a glance</p><h1>Your site, in view.</h1><p>Welcome back, {{ auth()->user()->name }}. Here’s what’s happening across your blog.</p></div>
<div class="admin-stats">
    <a href="/admin/blog" class="admin-stat"><span>Blog posts</span><strong>{{ $blogposts->count() }}</strong><p>{{ $blogunpublished->count() }} unpublished <span aria-hidden="true">↗</span></p></a>
    <a href="/admin/users" class="admin-stat"><span>Registered users</span><strong>{{ $users->count() }}</strong><p>{{ $users_admin }} administrators <span aria-hidden="true">↗</span></p></a>
    <a href="/admin/support" class="admin-stat"><span>Support tickets</span><strong>{{ $tickets->count() }}</strong><p>{{ $awaiting_reply }} awaiting reply <span aria-hidden="true">↗</span></p></a>
</div>
<div class="admin-two-column">
    <section class="admin-panel"><div class="admin-panel-heading"><h2>Community</h2><a href="/admin/users">Manage users →</a></div><dl class="admin-summary"><div><dt>Members</dt><dd>{{ $users_active }}</dd></div><div><dt>Pending / contributors</dt><dd>{{ $users_pending }}</dd></div><div><dt>Banned</dt><dd>{{ $users_banned }}</dd></div><div><dt>Administrators</dt><dd>{{ $users_admin }}</dd></div></dl></section>
    <section class="admin-panel"><div class="admin-panel-heading"><h2>Support queue</h2><a href="/admin/support">View tickets →</a></div><dl class="admin-summary"><div><dt>Open</dt><dd>{{ $open_tickets }}</dd></div><div><dt>In progress</dt><dd>{{ $in_progress_tickets }}</dd></div><div><dt>Awaiting reply</dt><dd>{{ $awaiting_reply }}</dd></div></dl></section>
</div>
<section class="admin-writing-prompt"><div><p class="admin-eyebrow">Make something worth reading</p><h2>What’s on your mind?</h2><p>Turn your next idea into a post.</p></div><a href="/blog/create" class="admin-button">Write a post →</a></section>
@endsection
