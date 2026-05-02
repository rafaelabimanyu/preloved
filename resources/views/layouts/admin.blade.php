<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Curation Studio') — preloved.g00ds</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
  @stack('head')
</head>
<body class="admin-body">

  {{-- Mobile sidebar overlay --}}
  <div class="admin-sidebar-overlay" id="admin-sidebar-overlay"></div>

  <div class="admin-layout">

    {{-- Sidebar --}}
    <aside class="admin-sidebar" id="admin-sidebar">
      <div class="admin-sidebar__brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">
          <span class="admin-brand-logo">preloved<span>.g00ds</span></span>
          <span class="admin-brand-sub">{{ __('admin.nav.studio') }}</span>
        </a>
      </div>

      <nav class="admin-nav">
        <span class="admin-nav__label">{{ __('admin.nav.overview') }}</span>
        <a href="{{ route('admin.dashboard') }}" class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          {{ __('admin.nav.dashboard') }}
        </a>

        <span class="admin-nav__label">{{ __('admin.nav.content') }}</span>
        <a href="{{ route('admin.drops.index') }}" class="admin-nav__link {{ request()->routeIs('admin.drops.*') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M2 12h3M19 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12"/></svg>
          {{ __('admin.nav.drops') }}
        </a>
        <a href="{{ route('admin.items.index') }}" class="admin-nav__link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
          {{ __('admin.nav.items') }}
        </a>
        <a href="{{ route('admin.lookbooks.index') }}" class="admin-nav__link {{ request()->routeIs('admin.lookbooks.*') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          {{ __('admin.nav.lookbooks') }}
        </a>

        <span class="admin-nav__label">{{ __('admin.nav.inbox') }}</span>
        <a href="{{ route('admin.inquiries.index') }}" class="admin-nav__link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          {{ __('admin.nav.inquiries') }}
          @php $unread = \App\Models\Inquiry::unread()->count(); @endphp
          @if ($unread > 0)
            <span class="admin-badge-count">{{ $unread }}</span>
          @endif
        </a>

        <span class="admin-nav__label">{{ __('admin.nav.system') }}</span>
        <a href="{{ route('admin.settings.index') }}" class="admin-nav__link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
          {{ __('admin.nav.settings') }}
        </a>
        <a href="{{ route('home') }}" target="_blank" class="admin-nav__link">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
          {{ __('admin.nav.view_site') }}
        </a>
      </nav>

      <div class="admin-sidebar__footer">
        <span class="admin-sidebar__user">{{ auth()->user()?->name ?? 'Admin' }}</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="admin-logout-btn">{{ __('admin.nav.sign_out') }}</button>
        </form>
      </div>
    </aside>

    {{-- Main Area --}}
    <div class="admin-main">
      <header class="admin-header">
        {{-- Mobile sidebar toggle --}}
        <button class="admin-sidebar-toggle" id="admin-sidebar-toggle" aria-label="Toggle navigation">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </button>
        <h1 class="admin-page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="admin-header__actions">@yield('header-actions')</div>
      </header>

      {{-- Flash --}}
      @if (session('success'))
        <div id="flash-message" class="alert alert--success" style="transition:opacity .4s,transform .4s;">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div id="flash-message" class="alert alert--error" style="transition:opacity .4s,transform .4s;">{{ session('error') }}</div>
      @endif

      <div class="admin-content">
        @yield('content')
      </div>
    </div>

  </div>

  @stack('scripts')
</body>
</html>
