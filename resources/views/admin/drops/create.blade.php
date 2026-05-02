@extends('layouts.admin')
@section('page-title', 'New Drop')
@section('header-actions')
  <a href="{{ route('admin.drops.index') }}" class="admin-action-link">← Back</a>
@endsection

@section('content')
@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
<form method="POST" action="{{ route('admin.drops.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="admin-form-grid">

    {{-- Main --}}
    <div class="admin-form-panel">
      <div class="admin-form-panel__title">Drop Details</div>

      <div class="form-group">
        <label class="form-label" for="title">Title *</label>
        <input id="title" name="title" type="text" class="form-input" value="{{ old('title') }}" placeholder="Tokyo Rain Vol.1" required />
        @error('title')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Story / Description</label>
        <textarea id="description" name="description" class="form-textarea" placeholder="Tell the story behind this drop...">{{ old('description') }}</textarea>
        @error('description')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
        <div class="form-group">
          <label class="form-label" for="released_at">Release Date</label>
          <input id="released_at" name="released_at" type="datetime-local" class="form-input" value="{{ old('released_at') }}" />
          @error('released_at')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="ended_at">End Date</label>
          <input id="ended_at" name="ended_at" type="datetime-local" class="form-input" value="{{ old('ended_at') }}" />
        </div>
      </div>
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Status</div>
        <div class="form-group">
          <select name="status" class="form-select">
            @foreach (['draft','scheduled','live','ended'] as $s)
              <option value="{{ $s }}" {{ old('status', 'draft') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Cover Image</div>
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
        @error('cover_image')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Create Drop</button>
    </div>

  </div>
</form>
@endsection
