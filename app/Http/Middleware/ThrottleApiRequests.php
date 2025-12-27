<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class ThrottleApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = 'api_' . $request->ip();
        
        $maxAttempts = 60; // Maximum number of attempts
        $decayMinutes = 1; // Time in minutes to decay attempts
        
        $current = \Illuminate\Support\Facades\Cache::get($key, 0);
        
        if ($current >= $maxAttempts) {
            throw new ThrottleRequestsException('Too Many Attempts.', null, [
                'X-RateLimit-Limit' => $maxAttempts,
                'X-RateLimit-Remaining' => 0,
                'X-RateLimit-Reset' => now()->addMinutes($decayMinutes)->getTimestamp(),
                'Retry-After' => $decayMinutes * 60,
            ]);
        }
        
        \Illuminate\Support\Facades\Cache::put($key, $current + 1, now()->addMinutes($decayMinutes));
        
        $response = $next($request);
        
        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $maxAttempts - $current - 1,
            'X-RateLimit-Reset' => now()->addMinutes($decayMinutes)->getTimestamp(),
        ]);
    }
}