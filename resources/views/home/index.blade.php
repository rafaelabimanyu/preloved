@extends('layouts.app')
@section('title', 'preloved.g00ds — Curated Vintage Fashion')

@section('content')

{{-- ══════════════════════════════════════════════════════════════════════════
     HERO — full-bleed, cinematic, bottom-anchored
══════════════════════════════════════════════════════════════════════════ --}}
<section class="hero">

  {{-- Background --}}
  <div class="hero__bg">
    @if ($activeDrop && $activeDrop->cover_image)
      <img src="{{ $activeDrop->coverImageUrl() }}"
           alt="{{ $activeDrop->title }}"
           style="filter:brightness(0.82) saturate(0.9);" />
    @else
      <div style="width:100%;height:100%;background:linear-gradient(170deg,#1c1a16 0%,#0e0d0b 55%,#121008 100%);"></div>
    @endif
  </div>
  <div class="hero__overlay"></div>

  {{-- Content — sits at the bottom --}}
  <div class="hero__content w-full">
    <div class="container">
      <div style="max-width:680px;">

        {{-- Label --}}
        <div class="flex gap-md animate-fade-up delay-1" style="align-items:center;margin-bottom:var(--space-lg);">
          <span style="display:block;width:32px;height:1px;background:var(--clr-sand-muted);"></span>
          <p class="t-label" style="color:var(--clr-sand);">
            @if ($activeDrop)
              Drop N°01 &nbsp;·&nbsp; Live Now
            @else
              preloved.g00ds &nbsp;·&nbsp; {{ date('Y') }}
            @endif
          </p>
        </div>

        {{-- Headline --}}
        <h1 class="t-display animate-fade-up delay-2">
          @if ($activeDrop)
            {{ $activeDrop->title }}
          @else
            Clothes with<br /><em>a past life.</em>
          @endif
        </h1>

        {{-- Sub-copy --}}
        <p class="t-body animate-fade-up delay-3"
           style="margin-top:var(--space-lg);max-width:420px;line-height:2;font-size:.88rem;">
          @if ($activeDrop?->description)
            {{ Str::limit($activeDrop->description, 130) }}
          @else
            Not fast fashion. Not mass-produced.<br />
            Each piece chosen for what it carries.
          @endif
        </p>

        {{-- CTAs --}}
        <div class="flex gap-md hero-ctas animate-fade-up delay-4" style="margin-top:var(--space-2xl);">
          @if ($activeDrop)
            <a href="{{ route('drops.show', $activeDrop) }}" class="btn btn--primary">
              Explore Drop
            </a>
          @endif
          <a href="{{ route('catalog.index') }}" class="btn btn--ghost">
            Browse Catalog
          </a>
        </div>

      </div>
    </div>

    {{-- Year stamp — bottom right, editorial --}}
    <div style="position:absolute;right:var(--space-xl);bottom:var(--space-xl);z-index:3;">
      <span class="t-label" style="color:var(--clr-text-muted);writing-mode:vertical-rl;letter-spacing:.25em;">
        {{ date('Y') }}
      </span>
    </div>
  </div>

  {{-- Scroll caret — pure CSS --}}
  <div style="position:absolute;bottom:var(--space-xl);left:50%;transform:translateX(-50%);z-index:3;">
    <span class="t-label" style="color:var(--clr-text-muted);display:flex;flex-direction:column;align-items:center;gap:6px;">
      <span style="display:block;width:1px;height:32px;background:var(--clr-border);animation:fadeUp 2s ease-in-out infinite alternate;"></span>
    </span>
  </div>

</section>

{{-- ══════════════════════════════════════════════════════════════════════════
     MANIFESTO — flanked lines, spare copy
══════════════════════════════════════════════════════════════════════════ --}}
<section class="section--sm" style="border-top:1px solid var(--clr-border-soft);">
  <div class="container--narrow text-center">

    {{-- Flanking lines --}}
    <div style="display:flex;align-items:center;gap:var(--space-xl);margin-bottom:var(--space-xl);">
      <span style="flex:1;height:1px;background:var(--clr-border-soft);"></span>
      <span class="t-label" style="color:var(--clr-stone);white-space:nowrap;">preloved.g00ds</span>
      <span style="flex:1;height:1px;background:var(--clr-border-soft);"></span>
    </div>

    <blockquote class="manifesto">
      Clothes carry memory.<br />
      <em>We carry them forward.</em>
    </blockquote>

    <p class="t-label mt-xl" style="color:var(--clr-stone);">
      Curated vintage · Drop-based · One of a kind
    </p>

  </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════════════
     ACTIVE DROP FEATURE — cinematic strip (only when live drop exists)
══════════════════════════════════════════════════════════════════════════ --}}
@if ($activeDrop)
<section style="border-top:1px solid var(--clr-border-soft);border-bottom:1px solid var(--clr-border-soft);">
  <div class="split-layout">

    {{-- Image half --}}
    <div class="split-col" style="background:var(--clr-bg-2);">
      <img src="{{ $activeDrop->coverImageUrl() }}"
           alt="{{ $activeDrop->title }}"
           style="width:100%;height:100%;object-fit:cover;filter:brightness(0.88) saturate(0.9);
                  transition:transform 1.2s var(--ease-out);"
           onmouseenter="this.style.transform='scale(1.03)'"
           onmouseleave="this.style.transform='scale(1)'" />
      <div style="position:absolute;top:var(--space-lg);left:var(--space-lg);">
        <span class="badge badge--live">Live</span>
      </div>
    </div>

    {{-- Text half --}}
    <div style="display:flex;flex-direction:column;justify-content:center;
                padding:var(--space-3xl) var(--space-2xl);background:var(--clr-bg-2);" data-animate>

      <p class="t-label mb-xl" style="color:var(--clr-stone);">
        Current Drop &nbsp;·&nbsp; {{ $activeDrop->released_at?->format('F Y') }}
      </p>

      <h2 class="t-display mb-lg" style="font-size:clamp(2rem,4vw,3.5rem);">
        {{ $activeDrop->title }}
      </h2>

      @if ($activeDrop->description)
        <p class="t-body mb-xl" style="max-width:400px;line-height:2;">
          {{ Str::limit($activeDrop->description, 180) }}
        </p>
      @endif

      <div style="display:flex;flex-direction:column;gap:var(--space-md);align-items:flex-start;">
        <a href="{{ route('drops.show', $activeDrop) }}" class="btn btn--primary">
          Enter Drop
        </a>
        <span class="t-label" style="color:var(--clr-stone);">
          {{ $activeDrop->items->where('status','available')->count() }} piece{{ $activeDrop->items->where('status','available')->count() !== 1 ? 's' : '' }} available
        </span>
      </div>

    </div>

  </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     ITEMS PREVIEW — archive grid
══════════════════════════════════════════════════════════════════════════ --}}
@if ($recentItems->isNotEmpty())
<section class="section">
  <div class="container">

    <div class="section-header">
      <div class="section-header__left">
        <p class="t-label mb-sm" style="color:var(--clr-stone);">01 — Archive</p>
        <h2 class="t-headline">Available now</h2>
      </div>
      <div class="section-header__right">
        <a href="{{ route('catalog.index') }}" class="btn--text">
          View all pieces
        </a>
        <p class="t-label mt-xs" style="color:var(--clr-text-muted);">
          {{ $recentItems->count() }} shown
        </p>
      </div>
    </div>

    <div class="grid-4">
      @foreach ($recentItems as $item)
        <div data-animate style="animation-delay:{{ $loop->index * 0.08 }}s;">
          <x-item-card :item="$item" />
        </div>
      @endforeach
    </div>

  </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     LOOKBOOK PREVIEW — editorial, portrait image
══════════════════════════════════════════════════════════════════════════ --}}
@if ($latestLookbook)
<section style="background:var(--clr-bg-2);
                border-top:1px solid var(--clr-border-soft);
                border-bottom:1px solid var(--clr-border-soft);
                padding:var(--space-3xl) 0;">
  <div class="container">

    {{-- text-first: text column left, portrait image right --}}
    <div class="split-layout split-layout--text-first">

      {{-- Text — leads the eye first on editorial layouts --}}
      <div class="split-col" data-animate style="display:flex;flex-direction:column;justify-content:center;padding:var(--space-xl) 0;">
        <p class="t-label mb-lg" style="color:var(--clr-stone);">
          02 — Editorial &nbsp;·&nbsp;
          {{ $latestLookbook->published_at?->format('M Y') }}
        </p>

        <h2 class="t-display mb-xl" style="font-size:clamp(1.8rem,3.5vw,3rem);line-height:1.15;">
          {{ $latestLookbook->title }}
        </h2>

        @if ($latestLookbook->description)
          <p class="t-body mb-xl" style="max-width:360px;line-height:2;">
            {{ Str::limit($latestLookbook->description, 160) }}
          </p>
        @endif

        <a href="{{ route('lookbook.show', $latestLookbook) }}" class="btn--text"
           style="font-size:.65rem;">
          Open Lookbook
        </a>
      </div>

      {{-- Portrait image — taller, cinematic --}}
      <div class="split-col" style="aspect-ratio:3/4;" data-animate>
        <img src="{{ $latestLookbook->coverImageUrl() }}"
             alt="{{ $latestLookbook->title }}"
             loading="lazy"
             style="width:100%;height:100%;object-fit:cover;
                    filter:brightness(0.9) saturate(0.92);
                    transition:transform 1.2s var(--ease-out), filter 1.2s var(--ease-out);"
             class="lookbook-hero-img" />
      </div>

    </div>

  </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     BRAND VALUES — horizontal, spare
══════════════════════════════════════════════════════════════════════════ --}}
<section class="section">
  <div class="container">

    <div class="split-layout" style="gap:var(--space-3xl);min-height:auto;align-items:start;">

      <div class="split-col" data-animate style="padding:var(--space-xl) 0;">
        <p class="t-label mb-xl" style="color:var(--clr-stone);">03 — Why preloved</p>
        <h2 class="t-headline" style="max-width:380px;line-height:1.2;">
          A different way<br /><em>to get dressed.</em>
        </h2>
      </div>

      <div class="split-col" data-animate style="display:flex;flex-direction:column;gap:var(--space-xl);justify-content:center;">
        @foreach ([
          ['Sustainable by design',  'Every piece we sell is one less garment manufactured. No packaging waste, no new emissions.'],
          ['One of a kind, always',  'Each item is a single piece. No restocks. No duplicates. The archive moves forward, not backward.'],
          ['Curated, not collected', 'We don\'t list everything we find. Each piece is chosen for its condition, story, and aesthetic coherence.'],
        ] as [$title, $body])
          <div style="padding-top:var(--space-lg);border-top:1px solid var(--clr-border-soft);">
            <h3 class="t-label mb-sm" style="color:var(--clr-text-primary);">{{ $title }}</h3>
            <p class="t-body" style="font-size:.82rem;max-width:400px;">{{ $body }}</p>
          </div>
        @endforeach
      </div>

    </div>

  </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════════════
     INSTAGRAM — quiet, not promotional
══════════════════════════════════════════════════════════════════════════ --}}
@php $ig = \App\Models\Setting::get('social.instagram'); @endphp
@if ($ig)
<div style="border-top:1px solid var(--clr-border-soft);padding:var(--space-2xl) 0;text-align:center;">
  <div class="container--narrow">
    <p class="t-body" style="font-size:.85rem;margin-bottom:var(--space-md);">
      The drops happen on Instagram first.
    </p>
    <a href="{{ $ig }}" target="_blank" rel="noopener" class="btn--text"
       style="font-size:.65rem;">
      Follow @preloved.g00ds
    </a>
  </div>
</div>
@endif

@endsection

@push('head')
<style>
  /* Lookbook hero image hover — CSS only, no inline JS */
  .lookbook-hero-img:hover {
    transform: scale(1.03);
    filter: brightness(0.95) saturate(1.0) !important;
  }

  /* Split col image — maintain aspect on mobile */
  @media (max-width: 640px) {
    .split-layout--text-first .split-col[style*="aspect-ratio"] {
      aspect-ratio: 4/3;  /* wider crop on mobile, less tall */
    }
    .split-layout .split-col img {
      max-height: 60vh;
      width: 100%;
      object-fit: cover;
    }
    /* Drop section text padding — reduce on mobile */
    .split-layout > div[style*="padding:var(--space-3xl)"] {
      padding: var(--space-xl) var(--space-md);
    }
  }
</style>
@endpush
