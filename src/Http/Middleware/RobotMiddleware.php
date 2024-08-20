<?php

namespace Narsil\Settings\Http\Middleware;

#region USE

use Closure;
use Illuminate\Http\Request;
use Narsil\Settings\Constants\Settings;
use Narsil\Settings\Models\Setting;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class RobotMiddleware
{
    #region CONSTANTS

    private const ROBOTS_ALL = 'all';
    private const ROBOTS_NONE = 'none';

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        $robots = Setting::get(Settings::ROBOTS, false);

        $content = $robots ? self::ROBOTS_ALL : self::ROBOTS_NONE;

        $response->headers->set('x-robots-tag', $content, false);

        return $response;
    }

    #endregion
}
