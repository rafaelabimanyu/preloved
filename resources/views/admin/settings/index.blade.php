@extends('layouts.admin')
@section('page-title', 'Brand Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf

  <div style="display:flex;flex-direction:column;gap:var(--space-xl);">

    @foreach ([
      'brand'   => 'Brand Identity',
      'social'  => 'Social Links',
      'seo'     => 'SEO & Meta',
      'contact' => 'Contact Info',
    ] as $group => $label)
      <div class="admin-form-panel">
        <div class="admin-form-panel__title">{{ $label }}</div>
        @foreach ($groups[$group] as $setting)
          <div class="form-group">
            <label class="form-label" for="{{ $setting->key }}">
              {{ ucwords(str_replace(['.', '_'], ' ', explode('.', $setting->key)[1] ?? $setting->key)) }}
            </label>

            @if ($setting->type === 'textarea')
              <textarea id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" class="form-textarea"
                style="min-height:80px;">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>

            @elseif ($setting->type === 'image')
              @if ($setting->value)
                <div style="margin-bottom:8px;">
                  <img src="{{ asset('storage/' . $setting->value) }}" style="max-height:80px;max-width:200px;object-fit:contain;" />
                </div>
              @endif
              <input type="file" name="{{ str_replace('.', '__', $setting->key) }}" accept="image/*" class="form-input" style="padding:8px;" />
              <p class="t-label" style="margin-top:4px;">Upload new image to replace</p>

            @elseif ($setting->type === 'boolean')
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input type="checkbox" name="settings[{{ $setting->key }}]" value="1"
                  {{ $setting->value ? 'checked' : '' }} style="accent-color:var(--clr-sand);" />
                <span class="t-body" style="font-size:.83rem;">Enabled</span>
              </label>

            @else
              <input id="{{ $setting->key }}" name="settings[{{ $setting->key }}]"
                type="{{ $setting->type === 'url' ? 'url' : 'text' }}"
                class="form-input"
                value="{{ old('settings.'.$setting->key, $setting->value) }}"
                placeholder="{{ $setting->key }}" />
            @endif
          </div>
        @endforeach
      </div>
    @endforeach

    <div style="display:flex;justify-content:flex-end;">
      <button type="submit" class="btn btn--primary" style="min-width:200px;justify-content:center;">Save Settings</button>
    </div>

  </div>
</form>
@endsection
