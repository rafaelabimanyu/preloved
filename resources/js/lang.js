/**
 * lang.js — client-side locale persistence for preloved.g00ds
 *
 * ARCHITECTURE:
 *   The server session is the single source of truth for the locale.
 *   This module mirrors the server-resolved locale into localStorage so
 *   client-side code can read the language instantly without a round-trip.
 *
 * FLOW:
 *   1. On every page load, we read the locale the server placed in
 *      <meta name="app-locale"> (set by SetLocale middleware → Blade layout).
 *   2. We write that value into localStorage['preloved_locale'].
 *   3. switchLanguage(lang) navigates to /change-language/{lang}, which
 *      updates the session and redirects back with the locale swapped in
 *      the URL. The next page load will then sync localStorage again.
 *
 * NOTE:
 *   We intentionally do NOT auto-redirect based on localStorage vs URL mismatch.
 *   Doing so would bypass the server and could cause redirect loops.
 *   The server session always wins; localStorage is a read cache only.
 */

const SUPPORTED    = ['en', 'id'];
const STORAGE_KEY  = 'preloved_locale';
const DEFAULT_LANG = 'en';

// ─── Read ─────────────────────────────────────────────────────────────────────

/**
 * Return the locale currently stored in localStorage.
 * Returns null if nothing is stored or the stored value is unsupported.
 */
export function getStoredLocale() {
    const val = localStorage.getItem(STORAGE_KEY);
    return SUPPORTED.includes(val) ? val : null;
}

/**
 * Return the locale the server resolved for this page.
 * Reads from <meta name="app-locale"> injected by the Blade layout.
 */
export function getServerLocale() {
    const meta = document.querySelector('meta[name="app-locale"]');
    const val  = meta?.getAttribute('content') ?? null;
    return SUPPORTED.includes(val) ? val : DEFAULT_LANG;
}

// ─── Write ────────────────────────────────────────────────────────────────────

/**
 * Persist a locale to localStorage.
 * Silently ignores unsupported values.
 */
export function setStoredLocale(lang) {
    if (SUPPORTED.includes(lang)) {
        localStorage.setItem(STORAGE_KEY, lang);
    }
}

// ─── Sync ─────────────────────────────────────────────────────────────────────

/**
 * Mirror the server locale into localStorage.
 * Called automatically on DOMContentLoaded.
 */
function syncFromServer() {
    const serverLocale = getServerLocale();
    setStoredLocale(serverLocale);
}

// ─── Switch ───────────────────────────────────────────────────────────────────

/**
 * Navigate to /change-language/{lang}.
 *
 * The server (LanguageController) will:
 *   1. Validate lang
 *   2. Write session(['locale' => lang])
 *   3. Swap the locale segment in the referrer URL
 *   4. Redirect back — the new page load will sync localStorage via syncFromServer()
 *
 * We pre-write localStorage immediately so any in-flight client reads
 * already see the new value before the redirect completes.
 *
 * @param {string} lang  - 'en' or 'id'
 */
export function switchLanguage(lang) {
    if (!SUPPORTED.includes(lang)) {
        console.warn(`[preloved lang] Unsupported locale: "${lang}"`);
        return;
    }

    // Optimistically update localStorage before the redirect
    setStoredLocale(lang);

    // Navigate to the server-side language switch endpoint
    window.location.href = `/change-language/${lang}`;
}

// ─── Boot ─────────────────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', syncFromServer);

// Expose on window for use in inline Blade scripts / Alpine.js
window.PrelovedLang = { switchLanguage, getStoredLocale, getServerLocale };
