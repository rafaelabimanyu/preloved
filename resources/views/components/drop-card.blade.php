@props(['drop'])

<a href="{{ route('drops.show', $drop) }}" class="card" style="display:block;text-decoration:none;">
  <div class="card__image">
    <img src="{{ $drop->coverImageUrl() }}" alt="{{ $drop->title }}" loading="lazy" />
    @if ($drop->isLive())
      <div style="position:absolute;top:12px;left:12px;">
        <span class="badge badge--live">{{ __('home.drop.live_badge') }}</span>
      </div>
    @endif
  </div>
  <div class="card__body">
    <div class="card__label t-label">
      {{ $drop->released_at ? $drop->released_at->format('M Y') : __('ui.common.coming_soon') }}
    </div>
    <h3 class="card__title">{{ $drop->title }}</h3>
    <div class="card__meta">
      <span class="t-body" style="font-size:.78rem;">
        {{ $drop->items_count ?? $drop->items->count() }} piece{{ ($drop->items_count ?? $drop->items->count()) !== 1 ? 's' : '' }}
      </span>
      <span class="badge badge--{{ $drop->status }}">{{ ucfirst($drop->status) }}</span>
    </div>
  </div>
</a>
