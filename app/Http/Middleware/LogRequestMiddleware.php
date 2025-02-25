<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $path)
    {
        $timestamp = Carbon::now()->timestamp;
        $headers = $request->headers->all();
        
        if (isset($headers['authorization'])) {
            $headers['authorization'] = substr($headers['authorization'][0], 0, 10) . str_repeat(
                '*',
                strlen($headers['authorization'][0]) - 10
            );
        }

        Log::channel($path)->debug(
            "[Request from {$request->ip()}] - $timestamp",
            ['headers' => $headers, 'body' => $request->all(), 'url' => $request->fullUrl()]
        );

        $response = $next($request);

        Log::channel($path)->debug(
            "[Response to {$request->ip()}] - $timestamp",
            ['body' => $response->content(), 'status' => $response->status()]
        );

        return $response;
    }
}
