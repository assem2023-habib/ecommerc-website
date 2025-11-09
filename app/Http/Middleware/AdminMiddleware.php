<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user() ?? $request->user();
        if (!$user || !$user->hasRole('admin')) {
            return $this->errorResponse(
                'Unauthorized. Admins only',
                [],
                403
            );
        }
        return $next($request);
    }
}
