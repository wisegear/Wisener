@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="admin-page-heading"><p class="admin-eyebrow">Community</p><h1>Users</h1><p>Manage memberships, review account details, and keep your community in good shape.</p></div>
<section class="admin-panel"><div class="admin-panel-heading"><h2>All users <span class="admin-badge">{{ $users->total() }}</span></h2><span class="admin-muted">Use the arrows to sort</span></div><div class="admin-table-scroll"><table class="admin-table"><thead><tr>
@foreach(['name' => 'Name', 'membership' => 'Membership', 'email' => 'Email', 'created_at' => 'Joined', 'trusted' => 'Trusted', 'notes' => 'Notes'] as $field => $label)
<th>{{ $label }} @if($field !== 'membership')<span class="admin-sort"><a href="/admin/users?field={{ $field }}&order=asc" aria-label="Sort {{ $label }} ascending">↑</a><a href="/admin/users?field={{ $field }}&order=desc" aria-label="Sort {{ $label }} descending">↓</a></span>@endif</th>
@endforeach
<th>Actions</th></tr></thead><tbody>
@forelse($users as $user)<tr><td><a class="admin-table-title admin-nowrap" href="/profile/{{ $user->name_slug }}">{{ $user->name }}</a></td><td><div class="admin-role-list">@foreach($user->user_roles as $role)<span class="admin-badge {{ $role->name === 'Admin' ? 'admin-badge-teal' : '' }}">{{ $role->name }}</span>@endforeach</div></td><td>{{ $user->email }}</td><td class="admin-nowrap">{{ $user->created_at->format('d M Y') }}</td><td>{{ $user->trusted ? 'Yes' : 'No' }}</td><td>{{ $user->notes ?: '—' }}</td><td><div class="admin-actions"><a href="/profile/{{ $user->name_slug }}/edit" class="admin-button-secondary">Edit</a><form action="/admin/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Do you really want to delete this user?');">@csrf @method('DELETE')<button class="admin-button-danger" type="submit" @disabled($user->lock === 1)>{{ $user->lock === 1 ? 'Locked' : 'Delete' }}</button></form></div></td></tr>
@empty<tr><td colspan="7" class="admin-empty">No users to display.</td></tr>@endforelse
</tbody></table></div><div class="admin-pagination">{{ $users->appends(Request::except('page'))->links() }}</div></section>
@endsection
