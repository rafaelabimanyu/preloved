@extends('layouts.admin')
@section('page-title', 'Add Item')
@section('header-actions')
  <a href="{{ route('admin.items.index') }}" class="admin-action-link">← Back</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="admin-form-grid">

    {{-- Main --}}
    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Item Info</div>

        <div class="form-group">
          <label class="form-label">Title *</label>
          <input name="title" type="text" class="form-input" value="{{ old('title') }}" placeholder="Harajuku Denim Jacket '98" required />
          @error('title')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label class="form-label">Story / Description</label>
          <textarea name="description" class="form-textarea" placeholder="Where did this piece come from? What makes it special?">{{ old('description') }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
          <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category" class="form-select" required>
              @foreach (['tops','bottoms','outerwear','accessories','shoes','bags'] as $cat)
                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Condition *</label>
            <select name="condition" class="form-select" required>
              @foreach (['mint','excellent','good','fair'] as $c)
                <option value="{{ $c }}" {{ old('condition', 'good') === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
          <div class="form-group">
            <label class="form-label">Size</label>
            <input name="size" type="text" class="form-input" value="{{ old('size') }}" placeholder="M / JP-L" />
          </div>
          <div class="form-group">
            <label class="form-label">Price (Rp) *</label>
            <input name="price" type="number" step="1000" class="form-input" value="{{ old('price') }}" placeholder="250000" required />
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Instagram URL</label>
          <input name="instagram_url" type="url" class="form-input" value="{{ old('instagram_url') }}" placeholder="https://instagram.com/p/..." />
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Measurements (cm)</div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--space-md);">
          @foreach (['chest','shoulder','length','sleeve','waist','hip'] as $m)
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">{{ ucfirst($m) }}</label>
              <input name="measurements[{{ $m }}]" type="number" step="0.5" class="form-input" value="{{ old('measurements.'.$m) }}" placeholder="—" />
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Status & Drop</div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-select" required>
            @foreach (['available','reserved','sold'] as $s)
              <option value="{{ $s }}" {{ old('status', 'available') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Assign to Drop</label>
          <select name="drop_id" class="form-select">
            <option value="">— None —</option>
            @foreach ($drops as $drop)
              <option value="{{ $drop->id }}" {{ old('drop_id') == $drop->id ? 'selected' : '' }}>{{ $drop->title }}</option>
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
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                style="accent-color:var(--clr-sand);" />
              <span class="tag-pill" style="color:{{ $tag->color }};border-color:{{ $tag->color }};">{{ $tag->name }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Cover Photo *</div>
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
        @error('cover_image')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Gallery Photos</div>
        <input type="file" name="gallery[]" accept="image/*" multiple class="form-input" style="padding:8px;" />
        <p class="t-label" style="margin-top:6px;">Select multiple files</p>
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Add to Archive</button>
    </div>

  </div>
</form>
@endsection
