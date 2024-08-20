<?php

namespace Narsil\Settings\Http\Middleware;

#region USE

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Narsil\Settings\Constants\Settings;
use Narsil\Settings\Models\Setting;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class SSLMiddleware
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $ssl = Setting::get(Settings::SSL, false);

        if (!$request->secure() && $ssl && !in_array(env('APP_ENV'), ['local']))
        {
            $uri = $request->getRequestUri();

            return Redirect::secure($uri);
        }

        return $next($request);
    }

    #endregion
}
