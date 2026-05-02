<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // ── Global web middleware ─────────────────────────────────────────────
        // SetLocale runs on every web request (public & admin).
        //   • On locale-prefixed routes  → reads {locale} from URL segment
        //   • On admin / auth routes     → falls back to session, then browser
        // This ensures app()->getLocale() is always correct for __() calls,
        // <html lang>, and URL generation via URL::defaults(['locale' => ...]).
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // ── Named middleware aliases ──────────────────────────────────────────
        $middleware->alias([
            'is_admin'   => \App\Http\Middleware\IsAdmin::class,
            'set_locale' => \App\Http\Middleware\SetLocale::class, // alias kept for explicit use
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
