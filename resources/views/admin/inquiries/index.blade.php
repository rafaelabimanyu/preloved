@extends('layouts.admin')
@section('page-title', 'Inquiries')

@section('content')
<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th></th><th>Name</th><th>Email / IG</th><th>Item</th><th>Message</th><th>Received</th><th></th></tr>
    </thead>
    <tbody>
      @forelse ($inquiries as $inquiry)
        <tr style="{{ !$inquiry->is_read ? 'background:rgba(196,168,130,0.03);' : '' }}">
          <td>
            @if (!$inquiry->is_read)
              <span style="display:inline-block;width:7px;height:7px;background:var(--clr-sand);border-radius:50%;"></span>
            @endif
          </td>
          <td style="color:var(--clr-text-primary);font-weight:{{ !$inquiry->is_read ? '400' : '300' }};">{{ $inquiry->name }}</td>
          <td>
            <div style="font-size:.8rem;color:var(--clr-text-secondary);">{{ $inquiry->email }}</div>
            @if ($inquiry->instagram_handle)
              <div class="t-label" style="margin-top:2px;color:var(--clr-stone);">{{ $inquiry->instagram_handle }}</div>
            @endif
          </td>
          <td class="t-label">{{ $inquiry->item?->title ?? '—' }}</td>
          <td style="max-width:240px;font-size:.82rem;color:var(--clr-text-secondary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
            {{ $inquiry->message }}
          </td>
          <td class="t-label">{{ $inquiry->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="admin-action-link">Read</a>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" style="text-align:center;padding:40px;" class="t-body">No inquiries yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@if ($inquiries->hasPages())
  <div style="margin-top:var(--space-lg);">{{ $inquiries->links() }}</div>
@endif
@endsection
