@props(['lookbook', 'featured' => false])

<a href="{{ route('lookbook.show', $lookbook) }}" class="card" style="display:block;text-decoration:none;">
  <div class="card__image" style="aspect-ratio:{{ $featured ? '3/4' : '4/3' }};">
    <img src="{{ $lookbook->coverImageUrl() }}" alt="{{ $lookbook->title }}" loading="lazy" />
  </div>
  <div class="card__body">
    <div class="card__label t-label">
      {{ $lookbook->published_at ? $lookbook->published_at->format('M Y') : 'Unpublished' }}
    </div>
    <h3 class="card__title" style="{{ $featured ? 'font-size:1.35rem;' : '' }}">
      {{ $lookbook->title }}
    </h3>
    @if ($lookbook->description)
      <p class="t-body mt-sm" style="font-size:.8rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:{{ $featured ? 3 : 2 }};-webkit-box-orient:vertical;">
        {{ $lookbook->description }}
      </p>
    @endif
  </div>
</a>
