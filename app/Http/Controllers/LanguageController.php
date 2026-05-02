<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * LanguageController — handles the /language/{lang} endpoint.
 *
 * Flow:
 *   1. Validate the requested language.
 *   2. Persist it to the session.
 *   3. Redirect back to the previous page (URL stays clean — no locale in path).
 */
class LanguageController extends Controller
{
    public const SUPPORTED = ['en', 'id'];

    public function switch(Request $request, string $lang): RedirectResponse
    {
        // 1. Sanitise & validate
        $lang = strtolower(trim($lang));
        if (! in_array($lang, self::SUPPORTED, strict: true)) {
            $lang = 'en';
        }

        // 2. Persist in server session
        session(['locale' => $lang]);

        // 3. Redirect back to the same page — URL is unchanged (no locale prefix)
        return redirect()->back(fallback: '/');
    }
}
