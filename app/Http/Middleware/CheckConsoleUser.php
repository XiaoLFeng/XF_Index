<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckConsoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (Response|RedirectResponse) $next
     * @return RedirectResponse|Response|string
     */
    public function handle(Request $request, Closure $next): Response|string|RedirectResponse
    {
        if (Auth::check()) {
            if (Auth::user()->admin == 1) {
                return $next($request);
            } else {
                return redirect()->route('no-permission');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
