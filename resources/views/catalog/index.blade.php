@extends('layouts.app')
@section('title', 'Catalog — preloved.g00ds')

@section('content')
<div class="page-top">

  {{-- Page Header --}}
  <div class="page-header">
    <div class="container">
      <p class="t-label mb-sm" style="color:var(--clr-stone);">{{ __('catalog.subtitle') }}</p>
      <h1 class="t-headline">{{ __('catalog.title') }}</h1>
    </div>
  </div>

  <section class="section">
    <div class="container">
    <div style="display:grid;grid-template-columns:200px 1fr;gap:var(--space-2xl);align-items:start;" class="grid-catalog">

        {{-- Mobile filter toggle (visible only on mobile via CSS) --}}
        <div style="grid-column:1/-1;">
          <button class="filter-toggle-btn" id="filter-toggle" aria-label="{{ __('catalog.filter.heading') }}">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/></svg>
            {{ __('catalog.filter.heading') }}
          </button>
        </div>

        {{-- Filter sidebar overlay (mobile) --}}
        <div class="filter-sidebar-overlay" id="filter-sidebar-overlay"></div>

        {{-- Filter Sidebar --}}
        <aside class="filter-sidebar">
          <form method="GET" action="{{ route('catalog.index') }}" id="filter-form">

            <div class="filter-group">
              <span class="filter-group__label">{{ __('catalog.filter.category') }}</span>
              @foreach ($categories as $cat)
                <label class="filter-option">
                  <input type="radio" name="category" value="{{ $cat }}"
                    {{ request('category') === $cat ? 'checked' : '' }}
                    onchange="document.getElementById('filter-form').submit();" />
                  <span class="filter-option__label">{{ ucfirst($cat) }}</span>
                </label>
              @endforeach
              @if (request('category'))
                <a href="{{ route('catalog.index', request()->except('category')) }}"
                  class="t-label mt-sm" style="color:var(--clr-stone);display:inline-block;">{{ __('catalog.filter.clear_one') }}</a>
              @endif
            </div>

            <div class="filter-group">
              <span class="filter-group__label">{{ __('catalog.filter.style_tag') }}</span>
              @foreach ($tags as $tag)
                <label class="filter-option">
                  <input type="radio" name="tag" value="{{ $tag->slug }}"
                    {{ request('tag') === $tag->slug ? 'checked' : '' }}
                    onchange="document.getElementById('filter-form').submit();" />
                  <span class="tag-pill" style="color:{{ $tag->color }};border-color:{{ $tag->color }};">{{ $tag->name }}</span>
                </label>
              @endforeach
            </div>

            <div class="filter-group">
              <span class="filter-group__label">{{ __('catalog.filter.status') }}</span>
              @foreach ([__('catalog.status.available') => 'available', __('catalog.status.reserved') => 'reserved'] as $label => $val)
                <label class="filter-option">
                  <input type="radio" name="status" value="{{ $val }}"
                    {{ request('status') === $val ? 'checked' : '' }}
                    onchange="document.getElementById('filter-form').submit();" />
                  <span class="filter-option__label">{{ $label }}</span>
                </label>
              @endforeach
            </div>

            @if (request()->hasAny(['category', 'tag', 'status']))
              <a href="{{ route('catalog.index') }}" class="btn btn--ghost"
                style="font-size:.6rem;padding:8px 16px;">{{ __('catalog.filter.clear_all') }}</a>
            @endif

          </form>
        </aside>

        {{-- Items Grid --}}
        <div>
          @if ($items->isEmpty())
            <div class="empty-state">
              <div class="empty-state__icon">◌</div>
              <p class="t-label mb-md">{{ __('catalog.empty.heading') }}</p>
              <p class="t-body">{{ __('catalog.empty.body') }}</p>
              @if (request()->hasAny(['category', 'tag', 'status']))
                <a href="{{ route('catalog.index') }}" class="btn--text mt-lg">{{ __('catalog.empty.open') }}</a>
              @endif
            </div>
          @else
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-lg);">
              <span class="t-label">
                {{ $items->total() }} piece{{ $items->total() !== 1 ? 's' : '' }}
              </span>
              @if (request()->hasAny(['category', 'tag', 'status']))
                <a href="{{ route('catalog.index') }}" class="t-label" style="color:var(--clr-stone);">{{ __('catalog.filter.clear_link') }}</a>
              @endif
            </div>

            <div class="grid-3">
              @foreach ($items as $item)
                <div data-animate>
                  <x-item-card :item="$item" />
                </div>
              @endforeach
            </div>

            @if ($items->hasPages())
              <div style="display:flex;justify-content:center;margin-top:var(--space-2xl);">
                {{ $items->links() }}
              </div>
            @endif
          @endif
        </div>

      </div>
    </div>
  </section>
</div>
@endsection
