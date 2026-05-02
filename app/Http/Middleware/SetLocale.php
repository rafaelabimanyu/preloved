<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SetLocale — resolves and applies the application locale on every request.
 *
 * Resolution order (first match wins):
 *   1. session('locale')        (persisted from a previous visit or language switch)
 *   2. Browser Accept-Language  (first-visit auto-detection)
 *   3. Hardcoded default → 'en'
 *
 * After resolving, the middleware:
 *   - Calls app()->setLocale($locale)
 *   - Persists the value in the session for future requests
 */
class SetLocale
{
    /** Languages supported by the application. */
    public const SUPPORTED = ['en', 'id'];

    /** Fallback when nothing else matches. */
    public const DEFAULT = 'en';

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolve($request);

        // 1. Apply to Laravel's translation layer
        app()->setLocale($locale);

        // 2. Persist to session (survives page navigation & reload)
        session(['locale' => $locale]);

        return $next($request);
    }

    // -------------------------------------------------------------------------

    private function resolve(Request $request): string
    {
        // Priority 1: previously persisted in the session
        $fromSession = session('locale');
        if ($fromSession && $this->isValid($fromSession)) {
            return $fromSession;
        }

        // Priority 2: browser Accept-Language header (first-visit detection)
        $fromBrowser = $this->detectFromBrowser($request);
        if ($fromBrowser) {
            return $fromBrowser;
        }

        // Priority 3: hardcoded default
        return self::DEFAULT;
    }

    private function isValid(?string $locale): bool
    {
        return in_array($locale, self::SUPPORTED, strict: true);
    }

    private function detectFromBrowser(Request $request): ?string
    {
        $header = $request->server('HTTP_ACCEPT_LANGUAGE', '');

        // Accept-Language can look like: "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7"
        // We extract the first two-letter language code.
        if (preg_match('/^([a-z]{2})/i', $header, $m)) {
            $lang = strtolower($m[1]);
            return $this->isValid($lang) ? $lang : null;
        }

        return null;
    }
}
