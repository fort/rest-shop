<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Closure;

class Localization
{
    public function handle($request, Closure $next)
    {
        $locale = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : null;
        try {
            $lang_code = Language::checkCodeOrReturnDefault($locale);
            app('translator')->setLocale($lang_code);
            return $next($request);
        }
        catch (ModelNotFoundException $ex) {
            return response($ex->getMessage(), 404);
        }
        
    }
}