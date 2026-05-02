<nav class="nav" id="main-nav">
  <div class="container">
    <div class="nav__inner">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="nav__logo" aria-label="preloved.g00ds home">
        preloved<span>.g00ds</span>
      </a>

      {{-- Desktop + mobile drawer links --}}
      <ul class="nav__links" id="nav-links" role="list">
        <li><a href="{{ route('drops.index') }}"   class="nav__link {{ request()->routeIs('drops.*')   ? 'active' : '' }}">{{ __('ui.nav.drops') }}</a></li>
        <li><a href="{{ route('catalog.index') }}"  class="nav__link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">{{ __('ui.nav.catalog') }}</a></li>
        <li><a href="{{ route('lookbook.index') }}" class="nav__link {{ request()->routeIs('lookbook.*')? 'active' : '' }}">{{ __('ui.nav.lookbook') }}</a></li>
        <li><a href="{{ route('about') }}"          class="nav__link {{ request()->routeIs('about')     ? 'active' : '' }}">{{ __('ui.nav.about') }}</a></li>
        <li>
          <a href="{{ \App\Models\Setting::get('social.instagram', '#') }}" target="_blank" rel="noopener" class="nav__link" aria-label="Instagram">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
          </a>
        </li>

        {{-- Language Toggle --}}
        <li class="nav__lang" aria-label="{{ __('ui.common.language') }}">
          <a href="{{ route('language.switch', 'en') }}"
             class="nav__lang-btn {{ app()->getLocale() === 'en' ? 'nav__lang-btn--active' : '' }}"
             aria-current="{{ app()->getLocale() === 'en' ? 'true' : 'false' }}">EN</a>
          <span class="nav__lang-sep">/</span>
          <a href="{{ route('language.switch', 'id') }}"
             class="nav__lang-btn {{ app()->getLocale() === 'id' ? 'nav__lang-btn--active' : '' }}"
             aria-current="{{ app()->getLocale() === 'id' ? 'true' : 'false' }}">ID</a>
        </li>
      </ul>

      {{-- Hamburger (mobile only) --}}
      <button class="nav__hamburger" id="nav-hamburger" aria-label="{{ __('ui.nav.toggle_menu') }}" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>

    </div>
  </div>
</nav>
