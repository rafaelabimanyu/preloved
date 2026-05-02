@extends('layouts.admin')
@section('page-title', 'Edit Item')
@section('header-actions')
  <a href="{{ route('admin.items.index') }}" class="admin-action-link">← Back</a>
  <a href="{{ route('items.show', $item) }}" target="_blank" class="admin-action-link">View on site ↗</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.items.update', $item) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="admin-form-grid">

    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Item Info</div>

        <div class="form-group">
          <label class="form-label">Title *</label>
          <input name="title" type="text" class="form-input" value="{{ old('title', $item->title) }}" required />
        </div>
        <div class="form-group">
          <label class="form-label">Story / Description</label>
          <textarea name="description" class="form-textarea">{{ old('description', $item->description) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
          <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category" class="form-select" required>
              @foreach (['tops','bottoms','outerwear','accessories','shoes','bags'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $item->category) === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Condition *</label>
            <select name="condition" class="form-select" required>
              @foreach (['mint','excellent','good','fair'] as $c)
                <option value="{{ $c }}" {{ old('condition', $item->condition) === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
          <div class="form-group">
            <label class="form-label">Size</label>
            <input name="size" type="text" class="form-input" value="{{ old('size', $item->size) }}" />
          </div>
          <div class="form-group">
            <label class="form-label">Price (Rp) *</label>
            <input name="price" type="number" step="1000" class="form-input" value="{{ old('price', $item->price) }}" required />
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Instagram URL</label>
          <input name="instagram_url" type="url" class="form-input" value="{{ old('instagram_url', $item->instagram_url) }}" />
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Measurements (cm)</div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--space-md);">
          @foreach (['chest','shoulder','length','sleeve','waist','hip'] as $m)
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">{{ ucfirst($m) }}</label>
              <input name="measurements[{{ $m }}]" type="number" step="0.5" class="form-input"
                value="{{ old('measurements.'.$m, $item->measurements[$m] ?? '') }}" placeholder="—" />
            </div>
          @endforeach
        </div>
      </div>

      {{-- Current gallery --}}
      @if ($item->images->isNotEmpty())
        <div class="admin-form-panel">
          <div class="admin-form-panel__title">Current Gallery</div>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            @foreach ($item->images as $img)
              <img src="{{ $img->url() }}" style="width:72px;height:90px;object-fit:cover;" />
            @endforeach
          </div>
        </div>
      @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Status & Drop</div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-select" required>
            @foreach (['available','reserved','sold'] as $s)
              <option value="{{ $s }}" {{ old('status', $item->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Assign to Drop</label>
          <select name="drop_id" class="form-select">
            <option value="">— None —</option>
            @foreach ($drops as $drop)
              <option value="{{ $drop->id }}" {{ old('drop_id', $item->drop_id) == $drop->id ? 'selected' : '' }}>{{ $drop->title }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Tags</div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
          @foreach ($tags as $tag)
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
              <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                {{ $item->tags->contains($tag->id) ? 'checked' : '' }}
                style="accent-color:var(--clr-sand);" />
              <span class="tag-pill" style="color:{{ $tag->color }};border-color:{{ $tag->color }};">{{ $tag->name }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Replace Cover Photo</div>
        @if ($item->cover_image)
          <img src="{{ $item->coverImageUrl() }}" style="width:100%;aspect-ratio:3/4;object-fit:cover;margin-bottom:var(--space-md);" />
        @endif
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Add Gallery Photos</div>
        <input type="file" name="gallery[]" accept="image/*" multiple class="form-input" style="padding:8px;" />
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Update Item</button>

      <form method="POST" action="{{ route('admin.items.destroy', $item) }}" onsubmit="return confirm('Delete this item permanently?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn--ghost w-full" style="justify-content:center;border-color:var(--clr-error);color:var(--clr-error);">Delete Item</button>
      </form>
    </div>

  </div>
</form>
@endsection
