@extends('layouts.admin')
@section('page-title', 'Lookbooks')
@section('header-actions')
  <a href="{{ route('admin.lookbooks.create') }}" class="btn btn--primary">+ New Lookbook</a>
@endsection

@section('content')
<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th>Cover</th><th>Title</th><th>Images</th><th>Published</th><th></th></tr>
    </thead>
    <tbody>
      @forelse ($lookbooks as $lb)
        <tr>
          <td>
            @if ($lb->cover_image)
              <img src="{{ $lb->coverImageUrl() }}" class="admin-table__thumb" style="aspect-ratio:4/3;" alt="{{ $lb->title }}" />
            @else
              <div style="width:60px;height:40px;background:var(--clr-bg-3);border:1px solid var(--clr-border-soft);"></div>
            @endif
          </td>
          <td style="color:var(--clr-text-primary);">{{ $lb->title }}</td>
          <td class="t-label">{{ $lb->images_count }} photos</td>
          <td class="t-label">{{ $lb->published_at?->format('d M Y') ?? '— Draft —' }}</td>
          <td>
            <div style="display:flex;gap:8px;">
              <a href="{{ route('admin.lookbooks.edit', $lb) }}" class="admin-action-link">Edit</a>
              <form method="POST" action="{{ route('admin.lookbooks.destroy', $lb) }}" onsubmit="return confirm('Delete this lookbook?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-action-link admin-action-link--danger" style="background:none;cursor:pointer;">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;" class="t-body">No lookbooks yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
