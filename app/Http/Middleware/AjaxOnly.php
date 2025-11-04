<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $request->ajax()) {
            // Wrap the original response content in your layout
            return response()->view('layouts.app', [
                'content' => $response->getContent()
            ]);
        }


        return $response;
    }

}



