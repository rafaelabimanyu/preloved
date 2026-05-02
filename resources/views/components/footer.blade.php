<footer class="footer">
  <div class="container">
    <div class="footer__grid">

      {{-- Brand --}}
      <div>
        <div class="footer__brand-name">preloved<span>.g00ds</span></div>
        <p class="footer__tagline">{{ __('ui.footer.tagline') }}</p>
        <p class="t-body" style="font-size:.8rem;max-width:260px;line-height:2;">
          {{ __('ui.footer.body') }}
        </p>
        <div class="flex gap-sm mt-lg">
          @php $ig = \App\Models\Setting::get('social.instagram'); @endphp
          @if($ig)
          <a href="{{ $ig }}" target="_blank" rel="noopener" class="btn--ghost" style="padding:8px 12px;border-radius:2px;" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
          </a>
          @endif
          @php $wa = \App\Models\Setting::get('social.whatsapp'); @endphp
          @if($wa)
          <a href="{{ $wa }}" target="_blank" rel="noopener" class="btn--ghost" style="padding:8px 12px;border-radius:2px;" aria-label="WhatsApp">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
          </a>
          @endif
        </div>
      </div>

      {{-- Shop --}}
      <div>
        <div class="footer__heading">{{ __('ui.footer.archive_heading') }}</div>
        <ul class="footer__links">
          <li><a href="{{ route('drops.index') }}"  class="footer__link">{{ __('ui.footer.all_drops') }}</a></li>
          <li><a href="{{ route('catalog.index') }}" class="footer__link">{{ __('ui.footer.browse_archive') }}</a></li>
          <li><a href="{{ route('lookbook.index') }}" class="footer__link">{{ __('ui.footer.editorial') }}</a></li>
        </ul>
      </div>

      {{-- Brand --}}
      <div>
        <div class="footer__heading">{{ __('ui.footer.brand_heading') }}</div>
        <ul class="footer__links">
          <li><a href="{{ route('about') }}"   class="footer__link">{{ __('ui.footer.manifesto_link') }}</a></li>
          <li><a href="{{ route('care') }}"    class="footer__link">{{ __('ui.nav.care') }}</a></li>
          <li><a href="{{ route('contact') }}" class="footer__link">{{ __('ui.nav.contact') }}</a></li>
        </ul>
      </div>

      {{-- Contact --}}
      <div>
        <div class="footer__heading">{{ __('ui.nav.contact') }}</div>
        <ul class="footer__links">
          @php $email = \App\Models\Setting::get('contact.email'); @endphp
          @if($email)
          <li><a href="mailto:{{ $email }}" class="footer__link">{{ $email }}</a></li>
          @endif
          @php $loc = \App\Models\Setting::get('contact.location'); @endphp
          @if($loc)
          <li><span class="footer__link" style="cursor:default;">{{ $loc }}</span></li>
          @endif
        </ul>
      </div>

    </div>

    <div class="footer__bottom">
      <span class="footer__copy">© {{ date('Y') }} preloved.g00ds — archive in motion.</span>
      <span class="footer__copy">{{ __('ui.footer.bottom_sub') }}</span>
    </div>
  </div>
</footer>
