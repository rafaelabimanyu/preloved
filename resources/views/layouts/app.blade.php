<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  {{-- Locale state: read by lang.js to sync localStorage --}}
  <meta name="app-locale" content="{{ app()->getLocale() }}" />
  <meta name="description" content="{{ \App\Models\Setting::get('seo.description', 'One-of-a-kind preloved fashion pieces. Tokyo streetwear, Y2K, Harajuku, vintage and minimalist curated drops.') }}" />

  <title>@yield('title', \App\Models\Setting::get('seo.title', 'preloved.g00ds — Curated Vintage Fashion'))</title>

  {{-- Open Graph --}}
  <meta property="og:type"        content="website" />
  <meta property="og:title"       content="@yield('og_title', \App\Models\Setting::get('seo.title', 'preloved.g00ds'))" />
  <meta property="og:description" content="@yield('og_description', \App\Models\Setting::get('seo.description', ''))" />
  <meta property="og:image"       content="@yield('og_image', asset('images/og/default.jpg'))" />
  <meta property="og:url"         content="{{ url()->current() }}" />

  {{-- Favicon --}}
  <link rel="icon" href="{{ asset('favicon.ico') }}" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('head')
</head>
<body>

  {{-- Navigation --}}
  <x-nav />

  {{-- Flash Messages --}}
  @if (session('success'))
    <div id="flash-message" class="alert alert--success" style="position:fixed;top:80px;right:24px;z-index:200;max-width:360px;transition:opacity .4s,transform .4s;">
      {{ session('success') }}
    </div>
  @endif

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  <x-footer />

  @stack('scripts')
</body>
</html>
