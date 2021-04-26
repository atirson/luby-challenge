<?php
namespace App\Http\Middleware;

use App\Util\Utils;
use Symfony\Component\HttpFoundation\Response;
use Closure;

/**
 * Implementação para solucionar problema de 'Cross-Origin Resource Sharing'.
 *
 * @package App\Http\Middleware
 */
class Cors
{

    /**
     * Intercepta a 'Request' e aplica a solução 'Cors'.
     *
     * @param $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        return $next($request)

            ->header('Access-Control-Allow-Origin', "*")
            ->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS")
            ->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
    }
}
