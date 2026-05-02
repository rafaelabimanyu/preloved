@extends('layouts.app')

@section('title', $drop->title . ' — preloved.g00ds')
@section('og_title', $drop->title)
@section('og_description', Str::limit($drop->description, 160))

@section('content')

{{-- ── DROP HERO ──────────────────────────────────────────────────────── --}}
<div class="hero page-top" style="min-height:70vh;">
  <div class="hero__bg">
    @if ($drop->cover_image)
      <img src="{{ $drop->coverImageUrl() }}" alt="{{ $drop->title }}" />
    @else
      <div style="width:100%;height:100%;background:var(--clr-bg-2);"></div>
    @endif
  </div>
  <div class="hero__overlay"></div>
  <div class="hero__content w-full">
    <div class="container">
      <a href="{{ route('drops.index') }}" class="t-label" style="color:var(--clr-stone);display:inline-flex;align-items:center;gap:6px;margin-bottom:20px;">
        {{ __('drops.show.back') }}
      </a>
      <div style="max-width:560px;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <span class="badge badge--{{ $drop->status }}">{{ ucfirst($drop->status) }}</span>
          @if ($drop->released_at)
            <span class="t-label">{{ $drop->released_at->format('F Y') }}</span>
          @endif
        </div>
        <h1 class="t-display animate-fade-up">{{ $drop->title }}</h1>
        @if ($drop->description)
          <p class="t-body animate-fade-up delay-2" style="margin-top:20px;max-width:500px;font-size:.95rem;">
            {{ $drop->description }}
          </p>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- ── DROP NARRATIVE INTRO ───────────────────────────────────────────── --}}
@if ($drop->isLive())
<div style="border-bottom:1px solid var(--clr-border-soft);padding:var(--space-xl) 0;">
  <div class="container--narrow text-center">
    <p class="manifesto" style="font-size:clamp(0.95rem,2vw,1.2rem);">
      Each piece in this drop was chosen by hand. One of a kind.
      When it's gone — it's gone.
    </p>
  </div>
</div>
@elseif ($drop->status === 'ended')
<div style="border-bottom:1px solid var(--clr-border-soft);padding:var(--space-xl) 0;">
  <div class="container--narrow text-center">
    <p class="t-label mb-sm" style="color:var(--clr-stone);">{{ __('drops.show.ended_label') }}</p>
    <p class="manifesto" style="font-size:clamp(0.95rem,2vw,1.2rem);">{{ __('drops.show.all_sold') }}</p>
  </div>
</div>
@endif

{{-- ── DROP ITEMS ─────────────────────────────────────────────────────── --}}
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-header__left">
        <p class="t-label mb-sm" style="color:var(--clr-stone);">{{ __('drops.show.selection_label') }}</p>
        <h2 class="t-title">{{ $drop->items->count() }} piece{{ $drop->items->count() !== 1 ? 's' : '' }}</h2>
      </div>
      <div class="section-header__right">
        <a href="{{ route('catalog.index') }}" class="btn--text">{{ __('drops.show.open_archive') }}</a>
      </div>
    </div>

    @if ($drop->items->isEmpty())
      <div class="empty-state">
        <p class="t-label mb-sm" style="color:var(--clr-stone);">{{ __('drops.show.curation_progress') }}</p>
        <p class="t-body">{{ __('drops.show.curation_body') }}</p>
      </div>
    @else
      <div class="grid-4">
        @foreach ($drop->items as $item)
          <div data-animate>
            <x-item-card :item="$item" />
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

@endsection
