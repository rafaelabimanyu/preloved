@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats --}}
<div class="admin-stats">
  @foreach ([
    [__('admin.stats.available'), $stats['available_items'], __('admin.stats.items')],
    [__('admin.stats.sold'),      $stats['sold_items'],      __('admin.stats.items')],
    [__('admin.stats.drops'),     $stats['total_drops'],     __('admin.stats.total')],
    [__('admin.stats.unread'),    $stats['unread_inquiries'],__('admin.stats.inquiries')],
  ] as [$label, $value, $sub])
    <div class="admin-stat-card">
      <div class="admin-stat-card__value">{{ $value }}</div>
      <div class="admin-stat-card__label">{{ $label }} {{ $sub }}</div>
    </div>
  @endforeach
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-xl);">

  {{-- Live Drop --}}
  <div class="admin-form-panel">
    <div class="admin-form-panel__title">{{ __('admin.dashboard.active_drop') }}</div>
    @if ($liveDrop)
      <div style="display:flex;gap:var(--space-md);align-items:center;margin-bottom:var(--space-lg);">
        @if ($liveDrop->cover_image)
          <img src="{{ $liveDrop->coverImageUrl() }}" style="width:60px;height:75px;object-fit:cover;" />
        @endif
        <div>
          <p style="font-family:var(--font-serif);font-size:1.1rem;color:var(--clr-text-primary);">{{ $liveDrop->title }}</p>
          <p class="t-label" style="margin-top:4px;">{{ __('admin.dashboard.pieces', ['count' => $liveDrop->items->count()]) }}</p>
        </div>
      </div>
      <a href="{{ route('admin.drops.edit', $liveDrop) }}" class="admin-action-link">{{ __('admin.dashboard.manage_drop') }}</a>
    @else
      <p class="t-body" style="font-size:.85rem;">{{ __('admin.dashboard.no_drop') }} <a href="{{ route('admin.drops.create') }}" style="color:var(--clr-sand);">{{ __('admin.dashboard.create_drop') }}</a></p>
    @endif
  </div>

  {{-- Recent Inquiries --}}
  <div class="admin-form-panel">
    <div class="admin-form-panel__title">{{ __('admin.dashboard.recent_inquiries') }}</div>
    @forelse ($recentInquiries as $inquiry)
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--clr-border-soft);">
        <div>
          <p style="font-size:.85rem;color:var(--clr-text-primary);">
            {{ $inquiry->name }}
            @if (!$inquiry->is_read)<span style="display:inline-block;width:6px;height:6px;background:var(--clr-sand);border-radius:50%;margin-left:6px;vertical-align:middle;"></span>@endif
          </p>
          <p class="t-label" style="margin-top:2px;">{{ $inquiry->created_at->diffForHumans() }}</p>
        </div>
        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="admin-action-link">{{ __('admin.table.view') }}</a>
      </div>
    @empty
      <p class="t-body" style="font-size:.85rem;">{{ __('admin.dashboard.no_inquiries') }}</p>
    @endforelse
    @if ($stats['unread_inquiries'] > 0)
      <a href="{{ route('admin.inquiries.index') }}" class="btn--text" style="margin-top:var(--space-md);font-size:.6rem;">{{ __('admin.dashboard.view_all') }}</a>
    @endif
  </div>

</div>

{{-- Recent Items --}}
<div class="admin-form-panel" style="margin-top:var(--space-xl);">
    <div class="admin-form-panel__title" style="display:flex;justify-content:space-between;">
    <span>{{ __('admin.dashboard.recent_items') }}</span>
    <a href="{{ route('admin.items.create') }}" class="btn btn--primary" style="padding:4px 14px;font-size:.6rem;">{{ __('admin.dashboard.add_item') }}</a>
  </div>
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr><th>{{ __('admin.table.item') }}</th><th>{{ __('admin.table.category') }}</th><th>{{ __('admin.table.price') }}</th><th>{{ __('admin.table.status') }}</th><th>{{ __('admin.table.drop') }}</th><th></th></tr>
      </thead>
      <tbody>
        @forelse ($recentItems as $item)
          <tr>
            <td style="display:flex;align-items:center;gap:10px;">
              <img src="{{ $item->coverImageUrl() }}" class="admin-table__thumb" alt="{{ $item->title }}" />
              <span style="color:var(--clr-text-primary);font-size:.85rem;">{{ $item->title }}</span>
            </td>
            <td><span class="t-label">{{ ucfirst($item->category) }}</span></td>
            <td class="t-price">{{ $item->formattedPrice() }}</td>
            <td><span class="badge badge--{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
            <td class="t-label">{{ $item->drop?->title ?? '—' }}</td>
            <td><a href="{{ route('admin.items.edit', $item) }}" class="admin-action-link">{{ __('admin.table.edit') }}</a></td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center t-body" style="padding:32px;">{{ __('admin.dashboard.no_items') }}</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
