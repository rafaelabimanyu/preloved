@extends('layouts.admin')
@section('page-title', 'Edit Lookbook')
@section('header-actions')
  <a href="{{ route('admin.lookbooks.index') }}" class="admin-action-link">← Back</a>
  <a href="{{ route('lookbook.show', $lookbook) }}" target="_blank" class="admin-action-link">View ↗</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.lookbooks.update', $lookbook) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="admin-form-grid">

    <div class="admin-form-panel">
      <div class="admin-form-panel__title">Details</div>
      <div class="form-group">
        <label class="form-label">Title *</label>
        <input name="title" type="text" class="form-input" value="{{ old('title', $lookbook->title) }}" required />
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-textarea">{{ old('description', $lookbook->description) }}</textarea>
      </div>

      {{-- Current images --}}
      @if ($lookbook->images->isNotEmpty())
        <div class="admin-form-panel__title" style="margin-top:var(--space-md);">Current Images</div>
        <div style="display:flex;flex-direction:column;gap:var(--space-md);">
          @foreach ($lookbook->images as $img)
            <div style="display:flex;gap:var(--space-md);align-items:center;padding:var(--space-sm) 0;border-bottom:1px solid var(--clr-border-soft);">
              <img src="{{ $img->url() }}" style="width:60px;height:75px;object-fit:cover;flex-shrink:0;" />
              <div style="flex:1;">
                @if ($img->caption)
                  <p style="font-size:.82rem;color:var(--clr-text-secondary);font-style:italic;">{{ $img->caption }}</p>
                @endif
                @if ($img->linkedItem)
                  <p class="t-label" style="margin-top:4px;color:var(--clr-sand);">→ {{ $img->linkedItem->title }}</p>
                @endif
              </div>
              <span class="t-label">#{{ $img->sort_order + 1 }}</span>
            </div>
          @endforeach
        </div>

        <div class="form-group" style="margin-top:var(--space-lg);">
          <label class="form-label">Add More Images</label>
          <input type="file" name="images[]" accept="image/*" multiple class="form-input" style="padding:8px;" />
        </div>
      @else
        <div class="form-group">
          <label class="form-label">Upload Images</label>
          <input type="file" name="images[]" accept="image/*" multiple class="form-input" style="padding:8px;" />
        </div>
      @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Publish Date</div>
        <div class="form-group" style="margin-bottom:0;">
          <input name="published_at" type="datetime-local" class="form-input"
            value="{{ old('published_at', $lookbook->published_at?->format('Y-m-d\TH:i')) }}" />
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Replace Cover</div>
        @if ($lookbook->cover_image)
          <img src="{{ $lookbook->coverImageUrl() }}" style="width:100%;aspect-ratio:4/3;object-fit:cover;margin-bottom:12px;" />
        @endif
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Update Lookbook</button>

      <form method="POST" action="{{ route('admin.lookbooks.destroy', $lookbook) }}" onsubmit="return confirm('Delete this lookbook?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn--ghost w-full" style="justify-content:center;border-color:var(--clr-error);color:var(--clr-error);">Delete</button>
      </form>
    </div>

  </div>
</form>
@endsection
