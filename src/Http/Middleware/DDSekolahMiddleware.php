<?php namespace Bantenprov\DDSekolah\Http\Middleware;

use Closure;

/**
 * The DDSekolahMiddleware class.
 *
 * @package Bantenprov\DDSekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class DDSekolahMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
