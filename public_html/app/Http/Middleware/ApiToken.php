<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apptoken = $request->header('apitoken');
       
        if ($apptoken && $apptoken != env('API_KEY')) {
            return response()->json('Unauthorized', 401);
        } 
        return $next($request);
    }
}
