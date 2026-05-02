@extends('layouts.admin')
@section('page-title', 'Drops')
@section('header-actions')
  <a href="{{ route('admin.drops.create') }}" class="btn btn--primary">+ New Drop</a>
@endsection

@section('content')
<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th>Cover</th><th>Title</th><th>Status</th><th>Released</th><th>Items</th><th></th></tr>
    </thead>
    <tbody>
      @forelse ($drops as $drop)
        <tr>
          <td>
            @if ($drop->cover_image)
              <img src="{{ $drop->coverImageUrl() }}" class="admin-table__thumb" alt="{{ $drop->title }}" />
            @else
              <div style="width:40px;height:50px;background:var(--clr-bg-3);border:1px solid var(--clr-border-soft);"></div>
            @endif
          </td>
          <td style="color:var(--clr-text-primary);">{{ $drop->title }}</td>
          <td><span class="badge badge--{{ $drop->status }}">{{ ucfirst($drop->status) }}</span></td>
          <td class="t-label">{{ $drop->released_at?->format('d M Y') ?? '—' }}</td>
          <td class="t-label">{{ $drop->items_count }}</td>
          <td>
            <div style="display:flex;gap:8px;">
              <a href="{{ route('admin.drops.edit', $drop) }}" class="admin-action-link">Edit</a>
              <form method="POST" action="{{ route('admin.drops.destroy', $drop) }}" onsubmit="return confirm('Delete this drop?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-action-link admin-action-link--danger" style="background:none;cursor:pointer;">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;" class="t-body">No drops yet. Create your first one.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@if ($drops->hasPages())
  <div style="margin-top:var(--space-lg);">{{ $drops->links() }}</div>
@endif
@endsection
