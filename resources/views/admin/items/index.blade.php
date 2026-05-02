@extends('layouts.admin')
@section('page-title', 'Items')
@section('header-actions')
  <a href="{{ route('admin.items.create') }}" class="btn btn--primary">+ New Item</a>
@endsection

@section('content')
<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th>Photo</th><th>Title</th><th>Category</th><th>Size</th><th>Price</th><th>Status</th><th>Drop</th><th></th></tr>
    </thead>
    <tbody>
      @forelse ($items as $item)
        <tr>
          <td><img src="{{ $item->coverImageUrl() }}" class="admin-table__thumb" alt="{{ $item->title }}" /></td>
          <td style="color:var(--clr-text-primary);max-width:200px;">{{ $item->title }}</td>
          <td><span class="t-label">{{ ucfirst($item->category) }}</span></td>
          <td class="t-label">{{ $item->size ?? '—' }}</td>
          <td class="t-price">{{ $item->formattedPrice() }}</td>
          <td><span class="badge badge--{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
          <td class="t-label" style="max-width:120px;">{{ $item->drop?->title ?? '—' }}</td>
          <td>
            <div style="display:flex;gap:8px;">
              <a href="{{ route('admin.items.edit', $item) }}" class="admin-action-link">Edit</a>
              <form method="POST" action="{{ route('admin.items.destroy', $item) }}" onsubmit="return confirm('Delete this item?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-action-link admin-action-link--danger" style="background:none;cursor:pointer;">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;" class="t-body">No items yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@if ($items->hasPages())
  <div style="margin-top:var(--space-lg);">{{ $items->links() }}</div>
@endif
@endsection
