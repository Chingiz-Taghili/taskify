<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = config('app.supported_locales');

        $locale = null;
        // 1. Custom header (main)
        if ($request->hasHeader('X-Locale')) {
            $locale = $request->header('X-Locale');
        }
        // 2. 'Accept-Language' header (fallback)
        if (!$locale) {
            $locale = $request->getPreferredLanguage($supportedLocales);
        }
        // 3. Validation and apply
        if ($locale && in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
