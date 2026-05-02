@extends('layouts.admin')
@section('page-title', 'Edit Drop')
@section('header-actions')
  <a href="{{ route('admin.drops.index') }}" class="admin-action-link">← Back</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.drops.update', $drop) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="admin-form-grid">

    <div class="admin-form-panel">
      <div class="admin-form-panel__title">Drop Details</div>

      <div class="form-group">
        <label class="form-label">Title *</label>
        <input name="title" type="text" class="form-input" value="{{ old('title', $drop->title) }}" required />
        @error('title')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <div class="form-group">
        <label class="form-label">Story / Description</label>
        <textarea name="description" class="form-textarea">{{ old('description', $drop->description) }}</textarea>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
        <div class="form-group">
          <label class="form-label">Release Date</label>
          <input name="released_at" type="datetime-local" class="form-input"
            value="{{ old('released_at', $drop->released_at?->format('Y-m-d\TH:i')) }}" />
        </div>
        <div class="form-group">
          <label class="form-label">End Date</label>
          <input name="ended_at" type="datetime-local" class="form-input"
            value="{{ old('ended_at', $drop->ended_at?->format('Y-m-d\TH:i')) }}" />
        </div>
      </div>

      {{-- Items in this drop --}}
      @if ($drop->items->isNotEmpty())
        <hr class="divider" />
        <div class="admin-form-panel__title">Items in this Drop</div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--space-sm);">
          @foreach ($drop->items as $item)
            <div style="background:var(--clr-bg-3);border:1px solid var(--clr-border-soft);padding:8px;display:flex;gap:8px;align-items:center;">
              <img src="{{ $item->coverImageUrl() }}" style="width:36px;height:45px;object-fit:cover;" />
              <div>
                <p style="font-size:.78rem;color:var(--clr-text-primary);">{{ Str::limit($item->title, 22) }}</p>
                <span class="badge badge--{{ $item->status }}" style="margin-top:2px;">{{ ucfirst($item->status) }}</span>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Status</div>
        <select name="status" class="form-select">
          @foreach (['draft','scheduled','live','ended'] as $s)
            <option value="{{ $s }}" {{ old('status', $drop->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
          @endforeach
        </select>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Cover Image</div>
        @if ($drop->cover_image)
          <img src="{{ $drop->coverImageUrl() }}" style="width:100%;aspect-ratio:3/2;object-fit:cover;margin-bottom:var(--space-md);" />
        @endif
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Update Drop</button>

      <form method="POST" action="{{ route('admin.drops.destroy', $drop) }}" onsubmit="return confirm('Permanently delete this drop?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn--ghost w-full" style="justify-content:center;border-color:var(--clr-error);color:var(--clr-error);">Delete Drop</button>
      </form>
    </div>

  </div>
</form>
@endsection
