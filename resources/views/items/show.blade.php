@extends('layouts.app')
@section('title', $item->title . ' — preloved.g00ds')
@section('og_title', $item->title)
@section('og_description', Str::limit($item->description, 160))

@section('content')
<div class="page-top">
<section class="section">
  <div class="container">

    <div class="grid-2 grid-editorial" style="gap:var(--space-2xl);align-items:start;">

      {{-- ── Photo Gallery ──────────────────────────────────────────────── --}}
      <div>
        {{-- Main photo --}}
        <div style="aspect-ratio:3/4;overflow:hidden;position:relative;background:var(--clr-bg-2);">
          @if ($item->isSold())
            <div class="sold-overlay">
              <span class="sold-overlay__text">{{ __('items.detail.sold_badge') }}</span>
            </div>
          @endif
          <img id="gallery-main"
               src="{{ $item->coverImageUrl() }}"
               alt="{{ $item->title }}"
               style="width:100%;height:100%;object-fit:cover;" />
        </div>

        {{-- Thumbnails --}}
        @if ($item->images->isNotEmpty())
          <div style="display:flex;gap:var(--space-sm);margin-top:var(--space-sm);overflow-x:auto;padding-bottom:4px;">
            <img data-gallery-thumb="{{ $item->coverImageUrl() }}"
                 src="{{ $item->coverImageUrl() }}"
                 alt="{{ $item->title }}"
                 class="gallery-thumb gallery-thumb--active" />
            @foreach ($item->images as $img)
              <img data-gallery-thumb="{{ $img->url() }}"
                   src="{{ $img->url() }}"
                   alt="Photo {{ $loop->iteration }}"
                   class="gallery-thumb" />
            @endforeach
          </div>
        @endif
      </div>

      {{-- ── Item Details ────────────────────────────────────────────────── --}}
      <div>
        {{-- Breadcrumb --}}
        <div style="display:flex;align-items:center;gap:var(--space-md);margin-bottom:var(--space-lg);">
          <a href="{{ route('catalog.index') }}" class="t-label" style="color:var(--clr-stone);">{{ __('items.detail.back_archive') }}</a>
          @if ($item->drop)
            <span class="t-label" style="color:var(--clr-border);">/</span>
            <a href="{{ route('drops.show', $item->drop) }}" class="t-label" style="color:var(--clr-sand);">
              {{ $item->drop->title }}
            </a>
          @endif
        </div>

        {{-- Category label --}}
        <p class="t-label mb-sm">{{ ucfirst($item->category) }}</p>

        {{-- Title --}}
        <h1 class="t-headline mb-lg">{{ $item->title }}</h1>

        {{-- Price + Status --}}
        <div class="flex gap-md" style="align-items:center;margin-bottom:var(--space-xl);">
          <span class="t-price" style="font-size:1.3rem;">{{ $item->formattedPrice() }}</span>
          <span class="badge badge--{{ $item->status }}">{{ ucfirst($item->status) }}</span>
        </div>

        {{-- Tags --}}
        @if ($item->tags->isNotEmpty())
          <div class="flex gap-sm mb-lg" style="flex-wrap:wrap;">
            @foreach ($item->tags as $tag)
              <a href="{{ route('catalog.index', ['tag' => $tag->slug]) }}"
                 class="tag-pill"
                 style="color:{{ $tag->color }};border-color:{{ $tag->color }};">
                {{ $tag->name }}
              </a>
            @endforeach
          </div>
        @endif

        {{-- Meta table --}}
        <div class="meta-table mb-xl">
          <div class="meta-row">
          <span class="meta-row__key">{{ __('items.detail.category') }}</span>
            <span class="meta-row__val">{{ ucfirst($item->category) }}</span>
          </div>
          <div class="meta-row">
          <span class="meta-row__key">{{ __('items.detail.size') }}</span>
            <span class="meta-row__val">{{ $item->size ?? '—' }}</span>
          </div>
          <div class="meta-row">
          <span class="meta-row__key">{{ __('items.detail.condition') }}</span>
            <span class="meta-row__val">{{ ucfirst($item->condition) }}</span>
          </div>
          @if ($item->measurements)
            @foreach ($item->measurements as $key => $val)
              @if ($val)
                <div class="meta-row">
                  <span class="meta-row__key">{{ ucfirst($key) }}</span>
                  <span class="meta-row__val">{{ $val }} cm</span>
                </div>
              @endif
            @endforeach
          @endif
        </div>

        {{-- Story --}}
        @if ($item->description)
          <p class="t-body mb-xl" style="line-height:2.1;">{{ $item->description }}</p>
        @endif

        {{-- CTAs --}}
        @if ($item->isAvailable())
          @php
            $ig = \App\Models\Setting::get('social.instagram');
            $wa = \App\Models\Setting::get('social.whatsapp');
          @endphp
          <div style="display:flex;flex-direction:column;gap:var(--space-sm);">
            @if ($ig)
              <a href="{{ $item->instagram_url ?? $ig }}" target="_blank" rel="noopener"
                 class="btn btn--primary w-full" style="justify-content:center;">
                {{ __('items.detail.inquire') }}
              </a>
            @endif
            @if ($wa)
              <a href="{{ $wa }}?text={{ urlencode('Hi! Saya tertarik dengan: ' . $item->title . ' — ' . url()->current()) }}"
                 target="_blank" rel="noopener"
                 class="btn btn--ghost w-full" style="justify-content:center;">
                {{ __('items.detail.inquire_wa') }}
              </a>
            @endif
            <a href="{{ route('contact') }}?item_id={{ $item->id }}"
               class="btn--text" style="text-align:center;margin-top:var(--space-xs);">
              {{ __('items.detail.inquire_email') }}
            </a>
          </div>

        @elseif ($item->status === 'reserved')
          <div style="padding:var(--space-xl);border:1px solid var(--clr-border-soft);">
            <p class="t-label mb-md" style="color:var(--clr-sand);">{{ __('items.detail.reserved_label') }}</p>
            <p class="t-body" style="font-size:.85rem;line-height:2;">
              {{ __('items.detail.reserved_body') }}
            </p>
          </div>

        @else
          <div style="padding:var(--space-xl);border:1px solid var(--clr-border-soft);">
            <p class="t-label mb-md" style="color:var(--clr-stone);">{{ __('items.detail.sold_label') }}</p>
            <p class="t-body mb-xl" style="font-size:.85rem;line-height:2;">
              {{ __('items.detail.sold_body') }}
            </p>
            <a href="{{ route('catalog.index') }}" class="btn--text">
              {{ __('items.detail.browse_more') }}
            </a>
          </div>
        @endif

        {{-- 1-of-1 note --}}
        <p class="t-label mt-xl" style="color:var(--clr-stone);text-align:center;">
          {{ __('items.detail.one_of_one') }}
        </p>
      </div>
    </div>

    {{-- Related Items --}}
    @if ($related->isNotEmpty())
      <div style="margin-top:var(--space-3xl);padding-top:var(--space-2xl);border-top:1px solid var(--clr-border-soft);">
        <p class="t-label mb-sm" style="color:var(--clr-stone);">{{ __('items.related.from_archive') }}</p>
        <h2 class="t-title mb-xl">{{ __('items.related.title') }}</h2>
        <div class="grid-4">
          @foreach ($related as $rel)
            <div data-animate><x-item-card :item="$rel" /></div>
          @endforeach
        </div>
      </div>
    @endif

  </div>
</section>
</div>

@push('scripts')
<script>
  // Gallery thumb switching
  const mainImg = document.getElementById('gallery-main');
  document.querySelectorAll('.gallery-thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
      mainImg.src = thumb.dataset.galleryThumb;
      document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('gallery-thumb--active'));
      thumb.classList.add('gallery-thumb--active');
    });
  });
</script>
@endpush

@endsection
