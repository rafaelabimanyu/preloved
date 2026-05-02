@extends('layouts.app')
@section('title', 'Our Story — preloved.g00ds')

@section('content')
<div class="page-top">

  {{-- ── HERO ─────────────────────────────────────────────────────────────── --}}
  <div class="page-header">
    <div class="container--narrow">
      <p class="t-label mb-md animate-fade-up" style="color:var(--clr-stone);">The Archive</p>
      <h1 class="t-display animate-fade-up delay-1">
        We are not<br /><em>a store.</em>
      </h1>
    </div>
  </div>

  {{-- ── MANIFESTO ────────────────────────────────────────────────────────── --}}
  <section class="section" style="border-bottom:1px solid var(--clr-border-soft);">
    <div class="container--narrow">

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-3xl);align-items:start;">

        {{-- Anchor label --}}
        <div data-animate>
          <p class="t-label mb-xl" style="color:var(--clr-stone);">Manifesto</p>
          <blockquote class="manifesto" style="font-size:clamp(1rem,2vw,1.4rem);text-align:left;margin:0;">
            Clothes carry memory.<br />
            <em>We carry them forward.</em>
          </blockquote>
        </div>

        {{-- Body --}}
        <div data-animate style="padding-top:var(--space-lg);">
          <p class="t-body mb-xl" style="line-height:2.1;">
            We are not interested in clothing as product.
            We are interested in clothing as record — the kind that holds a season,
            a posture, a particular version of someone who no longer exists.
          </p>
          <p class="t-body mb-xl" style="line-height:2.1;">
            Every piece in this archive was worn before it came to us.
            It passed through a city, a wardrobe, a chapter that is now closed.
            We found it. We chose it — not because it was available,
            but because it was worth carrying forward.
          </p>
          <p class="t-body" style="line-height:2.1;">
            preloved.g00ds does not sell fast. It does not sell volume.
            It releases — in drops, each one a small curated world.
            You wear the archive. You continue the narrative.
          </p>
        </div>

      </div>
    </div>
  </section>

  {{-- ── PRINCIPLES ───────────────────────────────────────────────────────── --}}
  <section class="section">
    <div class="container--narrow">

      <p class="t-label mb-2xl" style="color:var(--clr-stone);">The principles</p>

      <div style="display:flex;flex-direction:column;">
        @foreach ([
          ['Sustainable by design',
           'Fast fashion produces 10% of global carbon emissions. Every piece we sell is one less new garment manufactured. We don\'t preach — we simply operate differently.'],
          ['Curation, not collection',
           'We don\'t list everything we find. Each piece is assessed for condition, aesthetic coherence, and story. If it doesn\'t belong in the archive — it doesn\'t enter.'],
          ['One of a kind, always',
           'Quantity is always 1. There is no restock. No duplicates. Once a piece moves on — it moves on. That is not a limitation. That is the point.'],
          ['Drop-based, not stream-based',
           'We release in drops — each one a curated selection with a theme, a mood, a moment. Browse it like an editorial. Not a marketplace.'],
        ] as [$title, $body])
          <div data-animate style="display:grid;grid-template-columns:1fr 2fr;gap:var(--space-2xl);
                                   padding:var(--space-xl) 0;border-top:1px solid var(--clr-border-soft);
                                   align-items:start;">
            <h2 class="t-label" style="color:var(--clr-text-primary);padding-top:3px;">{{ $title }}</h2>
            <p class="t-body" style="line-height:2;">{{ $body }}</p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- ── CLOSING ──────────────────────────────────────────────────────────── --}}
  <div style="border-top:1px solid var(--clr-border-soft);padding:var(--space-3xl) 0;" class="text-center">
    <div class="container--narrow">
      <p class="t-body italic mb-xl" style="color:var(--clr-text-muted);font-size:.88rem;">
        "Every garment has lived. We find the ones worth a second chapter."
      </p>
      <a href="{{ route('drops.index') }}" class="btn--text">
        Enter the archive
      </a>
    </div>
  </div>

</div>
@endsection
