@extends('layouts.app')
@section('title', 'Say Hello — preloved.g00ds')

@section('content')
@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
<div class="page-top">

  <div class="page-header">
    <div class="container--narrow">
      <p class="t-label mb-md" style="color:var(--clr-stone);">Say Hello</p>
      <h1 class="t-display">Get in<br /><em>touch.</em></h1>
      <p class="t-body mt-md" style="max-width:480px;line-height:2;">
        A question about a piece. A reservation. A conversation.
        We're reachable on Instagram, WhatsApp, or through the form.
      </p>
    </div>
  </div>

  <section class="section">
    <div class="container--narrow">
      <div style="display:grid;grid-template-columns:1fr 340px;gap:var(--space-2xl);align-items:start;">

        {{-- Form --}}
        <div>
          <h2 class="t-title mb-xl">Leave a note</h2>

          @if (session('success'))
            <div class="alert alert--success mb-lg">{{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="form-group">
              <label class="form-label" for="name">{{ __('pages.contact.name') }}</label>
              <input id="name" name="name" type="text" class="form-input {{ ($errors ?? collect())->has('name') ? 'border-error' : '' }}"
                value="{{ old('name') }}" placeholder="Yuki Tanaka" required />
              @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label class="form-label" for="email">{{ __('pages.contact.email') }}</label>
              <input id="email" name="email" type="email" class="form-input"
                value="{{ old('email') }}" placeholder="you@email.com" required />
              @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label class="form-label" for="instagram_handle">Instagram (optional)</label>
              <input id="instagram_handle" name="instagram_handle" type="text" class="form-input"
                value="{{ old('instagram_handle') }}" placeholder="@your_handle" />
            </div>

            @if ($items->isNotEmpty())
              <div class="form-group">
                <label class="form-label" for="item_id">Asking about a specific piece?</label>
                <select id="item_id" name="item_id" class="form-select">
                  <option value="">— General inquiry —</option>
                  @foreach ($items as $it)
                    <option value="{{ $it->id }}" {{ (old('item_id', request('item_id')) == $it->id) ? 'selected' : '' }}>
                      {{ $it->title }}
                    </option>
                  @endforeach
                </select>
              </div>
            @endif

            <div class="form-group">
              <label class="form-label" for="message">{{ __('pages.contact.message') }}</label>
              <textarea id="message" name="message" class="form-textarea" placeholder="Write freely." required>{{ old('message') }}</textarea>
              @error('message')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">{{ __('pages.contact.send') }}</button>
          </form>
        </div>

        {{-- Info --}}
        <div style="padding-top:calc(var(--space-xl) + 24px);">
          @php
            $ig = \App\Models\Setting::get('social.instagram');
            $wa = \App\Models\Setting::get('social.whatsapp');
            $email = \App\Models\Setting::get('contact.email');
            $location = \App\Models\Setting::get('contact.location');
          @endphp

          <div style="display:flex;flex-direction:column;gap:var(--space-xl);">
            @if ($ig)
              <div>
                <p class="t-label mb-sm">Instagram</p>
                <a href="{{ $ig }}" target="_blank" rel="noopener" class="t-body" style="color:var(--clr-sand);">@preloved.g00ds</a>
                <p class="t-body" style="font-size:.8rem;margin-top:4px;">Fastest way to reach us.</p>
              </div>
            @endif
            @if ($wa)
              <div>
                <p class="t-label mb-sm">WhatsApp</p>
                <a href="{{ $wa }}" target="_blank" rel="noopener" class="t-body" style="color:var(--clr-sand);">{{ __('pages.contact.chat_whatsapp') }}</a>
              </div>
            @endif
            @if ($email)
              <div>
                <p class="t-label mb-sm">Email</p>
                <a href="mailto:{{ $email }}" class="t-body" style="color:var(--clr-text-secondary);">{{ $email }}</a>
              </div>
            @endif
            @if ($location)
              <div>
                <p class="t-label mb-sm">Based in</p>
                <p class="t-body">{{ $location }}</p>
              </div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
@endsection
