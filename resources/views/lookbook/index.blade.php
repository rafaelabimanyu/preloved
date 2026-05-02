@extends('layouts.app')
@section('title', 'Lookbook — preloved.g00ds')

@section('content')
<div class="page-top">

  {{-- Editorial Header --}}
  <div class="page-header">
    <div class="container">
      <p class="t-label mb-sm">Editorial</p>
      <h1 class="t-headline">Lookbook</h1>
      <p class="t-body mt-md" style="max-width:480px;">
        Not a catalog. A point of view. Each series is shot in real spaces, on real days —
        exploring what it means to wear something with intention.
      </p>
    </div>
  </div>

  <section class="section">
    <div class="container">
      @if ($lookbooks->isEmpty())
        <div class="empty-state">
          <div class="empty-state__icon">◎</div>
          <p class="t-label mb-md">First editorial in progress</p>
          <p class="t-body">Something is being made. Follow along on Instagram.</p>
        </div>
      @else
        @php $col = $lookbooks->getCollection(); @endphp

        {{-- Featured pair: first two books side by side, staggered heights --}}
        @if ($col->count() >= 2)
          <div class="grid-2 grid-editorial mb-2xl" style="align-items:start;gap:var(--space-xl);">
            <div data-animate style="padding-top:var(--space-2xl);">
              <x-lookbook-card :lookbook="$col->first()" :featured="true" />
            </div>
            <div data-animate>
              <x-lookbook-card :lookbook="$col->skip(1)->first()" />
            </div>
          </div>

          {{-- Remaining in standard 3-col --}}
          @if ($col->count() > 2)
            <div class="grid-3">
              @foreach ($col->skip(2) as $lookbook)
                <div data-animate><x-lookbook-card :lookbook="$lookbook" /></div>
              @endforeach
            </div>
          @endif
        @else
          {{-- Only 1 lookbook --}}
          <div style="max-width:640px;" data-animate>
            <x-lookbook-card :lookbook="$col->first()" :featured="true" />
          </div>
        @endif

        @if ($lookbooks->hasPages())
          <div style="margin-top:var(--space-2xl);display:flex;justify-content:center;">
            {{ $lookbooks->links() }}
          </div>
        @endif
      @endif
    </div>
  </section>

</div>
@endsection
