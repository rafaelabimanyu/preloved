@extends('layouts.admin')
@section('page-title', 'Inquiry')
@section('header-actions')
  <a href="{{ route('admin.inquiries.index') }}" class="admin-action-link">← Inbox</a>
@endsection

@section('content')
<div style="max-width:680px;">
  <div class="admin-form-panel">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:var(--space-xl);">
      <div>
        <h2 style="font-family:var(--font-serif);font-size:1.4rem;font-weight:300;color:var(--clr-text-primary);">
          {{ $inquiry->name }}
        </h2>
        <p class="t-label" style="margin-top:4px;">{{ $inquiry->created_at->format('d F Y, H:i') }}</p>
      </div>
      <span class="badge {{ $inquiry->is_read ? 'badge--ended' : 'badge--available' }}">
        {{ $inquiry->is_read ? 'Read' : 'Unread' }}
      </span>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-lg);margin-bottom:var(--space-xl);">
      <div>
        <p class="t-label mb-sm">Email</p>
        <a href="mailto:{{ $inquiry->email }}" style="color:var(--clr-sand);font-size:.875rem;">{{ $inquiry->email }}</a>
      </div>
      @if ($inquiry->instagram_handle)
        <div>
          <p class="t-label mb-sm">Instagram</p>
          <a href="https://instagram.com/{{ ltrim($inquiry->instagram_handle, '@') }}" target="_blank" style="color:var(--clr-sand);font-size:.875rem;">
            {{ $inquiry->instagram_handle }}
          </a>
        </div>
      @endif
    </div>

    @if ($inquiry->item)
      <div style="background:var(--clr-bg-3);border:1px solid var(--clr-border-soft);padding:var(--space-md);margin-bottom:var(--space-xl);display:flex;gap:var(--space-md);align-items:center;">
        <img src="{{ $inquiry->item->coverImageUrl() }}" style="width:48px;height:60px;object-fit:cover;" />
        <div>
          <p class="t-label mb-xs">Inquiring about</p>
          <p style="font-family:var(--font-serif);font-size:1rem;color:var(--clr-text-primary);">{{ $inquiry->item->title }}</p>
          <p class="t-price" style="font-size:.82rem;">{{ $inquiry->item->formattedPrice() }}</p>
        </div>
        <a href="{{ route('admin.items.edit', $inquiry->item) }}" class="admin-action-link" style="margin-left:auto;">Edit Item</a>
      </div>
    @endif

    <div>
      <p class="t-label mb-sm">Message</p>
      <div style="background:var(--clr-bg-3);border:1px solid var(--clr-border-soft);padding:var(--space-lg);">
        <p style="font-size:.9rem;color:var(--clr-text-secondary);line-height:1.8;white-space:pre-wrap;">{{ $inquiry->message }}</p>
      </div>
    </div>

    <div style="display:flex;gap:var(--space-md);margin-top:var(--space-xl);">
      <a href="mailto:{{ $inquiry->email }}?subject=Re: preloved.g00ds inquiry" class="btn btn--primary">Reply via Email</a>
      @if ($inquiry->instagram_handle)
        <a href="https://instagram.com/{{ ltrim($inquiry->instagram_handle, '@') }}" target="_blank" class="btn btn--ghost">Open Instagram</a>
      @endif
    </div>
  </div>
</div>
@endsection
