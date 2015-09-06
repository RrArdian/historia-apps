<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\ApiKey;

class ApiKeyMiddleware
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
        if (ApiKey::where('client_id', $request->input('client_id'))->first()) {
            
            $data = ApiKey::where('client_id', $request->input('client_id'))->pluck('client_secret');

            if ($data != $request->input('client_secret')) {

                if ($request->ajax())
                {
                    return response('Unauthorized.', 401);
                }
                else
                {
                    return response()->json(['error' => 401, 'error_description' => 'Missing credential']);
                }
            } else {

                return $next($request);
            }
        }

        return response()->json(['error' => 401, 'error_description' => 'Missing credential']);
    }
}
