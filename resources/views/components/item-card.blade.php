@props(['item'])

<a href="{{ route('items.show', $item) }}" class="card" style="display:block;text-decoration:none;">
  <div class="card__image">
    <img src="{{ $item->coverImageUrl() }}" alt="{{ $item->title }}" loading="lazy" />
    @if ($item->isSold())
      <div class="sold-overlay">
        <span class="sold-overlay__text">{{ __('ui.common.sold_badge') }}</span>
      </div>
    @elseif ($item->status === 'reserved')
      <div style="position:absolute;top:12px;left:12px;">
        <span class="badge badge--reserved">{{ __('ui.common.on_hold') }}</span>
      </div>
    @endif
  </div>
  <div class="card__body">
    <div class="card__label t-label">{{ ucfirst($item->category) }}</div>
    <h3 class="card__title">{{ $item->title }}</h3>
    @if ($item->tags->isNotEmpty())
      <div class="flex gap-sm mt-sm" style="flex-wrap:wrap;">
        @foreach ($item->tags->take(2) as $tag)
          <span class="tag-pill" style="color:{{ $tag->color }};border-color:{{ $tag->color }};">{{ $tag->name }}</span>
        @endforeach
      </div>
    @endif
    <div class="card__meta">
      <span class="t-price">{{ $item->formattedPrice() }}</span>
      <span class="t-body" style="font-size:.75rem;">{{ __('ui.common.size') }} {{ $item->size ?? '—' }}</span>
    </div>
  </div>
</a>
