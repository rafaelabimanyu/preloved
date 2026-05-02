@extends('layouts.app')
@section('title', 'Drops — preloved.g00ds')

@section('content')
<div class="page-top">

  {{-- Page Header --}}
  <div class="page-header">
    <div class="container">
      <p class="t-label mb-sm">{{ __('drops.index.label') }}</p>
      <h1 class="t-headline">{{ __('drops.index.title') }}</h1>
      <p class="t-body mt-md" style="max-width:460px;">
        {{ __('drops.index.subtitle') }}
      </p>
    </div>
  </div>

  {{-- Grid --}}
  <section class="section">
    <div class="container">
      @if ($drops->isEmpty())
        <div class="empty-state">
          <div class="empty-state__icon">◌</div>
          <p class="t-label mb-md">{{ __('drops.index.empty') }}</p>
          <p class="t-body">{{ __('drops.index.empty_body') }}</p>
        </div>
      @else
        <div class="grid-3">
          @foreach ($drops as $drop)
            <div data-animate>
              <x-drop-card :drop="$drop" />
            </div>
          @endforeach
        </div>

        @if ($drops->hasPages())
          <div style="margin-top:var(--space-2xl);display:flex;justify-content:center;">
            {{ $drops->links() }}
          </div>
        @endif
      @endif
    </div>
  </section>

</div>
@endsection
