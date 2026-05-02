@extends('layouts.app')
@section('title', $lookbook->title . ' — Lookbook — preloved.g00ds')
@section('og_title', $lookbook->title)
@section('og_description', Str::limit($lookbook->description, 160))

@section('content')
<div class="page-top">

  {{-- Header --}}
  <div class="page-header">
    <div class="container--narrow">
      <a href="{{ route('lookbook.index') }}" class="t-label mb-lg" style="color:var(--clr-stone);display:inline-block;">← Editorial</a>
      <p class="t-label mb-sm">{{ $lookbook->published_at?->format('F Y') }}</p>
      <h1 class="t-headline">{{ $lookbook->title }}</h1>
      @if ($lookbook->description)
        <p class="t-body mt-md" style="max-width:560px;">{{ $lookbook->description }}</p>
      @endif
    </div>
  </div>

  {{-- Editorial Flow --}}
  <section class="section">
    <div class="container--narrow">
      @forelse ($lookbook->images as $image)
        <div class="lookbook-image-block" data-animate>

          {{-- Full-width image --}}
          <img src="{{ $image->url() }}"
               alt="{{ $image->caption ?? $lookbook->title }}"
               style="width:100%;max-height:85vh;object-fit:cover;display:block;" />

          {{-- Caption + Linked item --}}
          @if ($image->caption || ($image->linkedItem ?? null))
            <div class="lookbook-image-block__caption">

              {{-- Caption text --}}
              <p class="t-body italic" style="font-size:.85rem;max-width:480px;">
                {{ $image->caption ?? '' }}
              </p>

              {{-- Shoppable item link --}}
              @if ($image->linkedItem ?? null)
                <a href="{{ route('items.show', $image->linkedItem) }}" class="lookbook-item-link">
                  <img src="{{ $image->linkedItem->coverImageUrl() }}"
                       alt="{{ $image->linkedItem->title }}"
                       class="lookbook-item-link__thumb" />
                  <div>
                    <p class="lookbook-item-link__wearing">Wearing</p>
                    <p class="lookbook-item-link__name">{{ $image->linkedItem->title }}</p>
                    <p class="lookbook-item-link__price">{{ $image->linkedItem->formattedPrice() }}</p>
                  </div>
                </a>
              @endif
            </div>
          @endif
        </div>
      @empty
        <div class="empty-state">
          <p class="t-body">No images in this lookbook yet.</p>
        </div>
      @endforelse
    </div>
  </section>

  {{-- Back nav --}}
  <div style="padding:var(--space-2xl) 0;border-top:1px solid var(--clr-border-soft);text-align:center;">
    <a href="{{ route('lookbook.index') }}" class="btn--text">← All editorials</a>
  </div>

</div>
@endsection
