@extends('layouts.admin')
@section('title', 'Support')
@section('content')
<div class="admin-page-heading"><p class="admin-eyebrow">Inbox</p><h1>Support</h1><p>Follow conversations, reply to questions, and keep things moving.</p></div>
<div class="admin-tabs" aria-label="Ticket filters"><a href="/admin/support" class="{{ !request()->has('closed') ? 'is-active' : '' }}">Active tickets</a><a href="/admin/support?closed=true" class="{{ request()->has('closed') ? 'is-active' : '' }}">Closed tickets</a></div>
<section class="admin-panel"><div class="admin-panel-heading"><h2>{{ request()->has('closed') ? 'Closed' : 'Active' }} tickets <span class="admin-badge">{{ $tickets->total() }}</span></h2></div><div class="admin-table-scroll"><table class="admin-table"><thead><tr><th>Conversation</th><th>Opened by</th><th>Last reply</th><th>Replied by</th><th>Replies</th><th>Status</th></tr></thead><tbody>
@forelse($tickets as $ticket)<tr><td><a class="admin-table-title" href="/support/{{ $ticket->id }}">{{ $ticket->title }}</a></td><td>{{ $ticket->users->name }}</td><td class="admin-nowrap">{{ $ticket->comments->last()?->created_at->diffForHumans() ?? 'No replies yet' }}</td><td>{{ $ticket->comments->last()?->user?->name ?? '—' }}</td><td>{{ $ticket->comments->count() }}</td><td><span class="admin-badge {{ $ticket->status === 'Open' ? 'admin-badge-teal' : '' }}">{{ $ticket->status }}</span></td></tr>
@empty<tr><td colspan="6" class="admin-empty"><strong>{{ request()->has('closed') ? 'No closed tickets' : 'You’re all caught up.' }}</strong><p>{{ request()->has('closed') ? 'Resolved conversations will appear here.' : 'Active support conversations will appear here when someone gets in touch.' }}</p></td></tr>@endforelse
</tbody></table></div><div class="admin-pagination">{{ $tickets->appends(request()->only('closed'))->links() }}</div></section>
@endsection
