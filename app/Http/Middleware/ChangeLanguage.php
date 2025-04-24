<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguage
{
    /**
     * Handle language on incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if 'lang' is provided in the request (query param or header)
        $locale = $request->query('lang', $request->header('Accept-Language'));

        // List of supported languages
        $supportedLocales = ['en', 'ar']; // Add your supported locales

        // Set the app locale if it's in the supported list
        if ($locale && in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
