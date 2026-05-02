@extends('layouts.admin')
@section('page-title', 'New Lookbook')
@section('header-actions')
  <a href="{{ route('admin.lookbooks.index') }}" class="admin-action-link">← Back</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.lookbooks.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="admin-form-grid">

    <div class="admin-form-panel">
      <div class="admin-form-panel__title">Lookbook Details</div>

      <div class="form-group">
        <label class="form-label">Title *</label>
        <input name="title" type="text" class="form-input" value="{{ old('title') }}" placeholder="Tokyo Quiet Season" required />
        @error('title')<p class="form-error">{{ $message }}</p>@enderror
      </div>

      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-textarea" placeholder="What mood or story does this editorial capture?">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label class="form-label">Images (multiple)</label>
        <input type="file" name="images[]" accept="image/*" multiple class="form-input" style="padding:8px;" id="image-input" />
        <p class="t-label" style="margin-top:6px;">Select in the order you want them displayed.</p>
        <div id="image-previews" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:12px;"></div>
      </div>

      <div id="caption-fields"></div>
    </div>

    <div style="display:flex;flex-direction:column;gap:var(--space-md);">
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Publish Date</div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Published At</label>
          <input name="published_at" type="datetime-local" class="form-input" value="{{ old('published_at') }}" />
          <p class="t-label" style="margin-top:6px;">Leave blank to save as draft.</p>
        </div>
      </div>

      <div class="admin-form-panel">
        <div class="admin-form-panel__title">Cover Image</div>
        <input type="file" name="cover_image" accept="image/*" class="form-input" style="padding:8px;" />
      </div>

      <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">Publish Lookbook</button>
    </div>

  </div>
</form>

@push('scripts')
<script>
  const input = document.getElementById('image-input');
  const previews = document.getElementById('image-previews');
  const captions = document.getElementById('caption-fields');

  input.addEventListener('change', () => {
    previews.innerHTML = '';
    captions.innerHTML = '<div class="admin-form-panel__title" style="margin-top:16px;">Captions (optional)</div>';
    Array.from(input.files).forEach((file, i) => {
      const url = URL.createObjectURL(file);
      const img = document.createElement('img');
      img.src = url;
      img.style = 'width:80px;height:100px;object-fit:cover;border:1px solid var(--clr-border-soft);';
      previews.appendChild(img);

      const wrap = document.createElement('div');
      wrap.className = 'form-group';
      wrap.innerHTML = `<label class="form-label">Image ${i+1} caption</label>
        <input name="captions[${i}]" type="text" class="form-input" placeholder="Optional caption..." />`;
      captions.appendChild(wrap);
    });
  });
</script>
@endpush
@endsection
