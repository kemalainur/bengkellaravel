<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomer
{
    /**
     * Handle an incoming request for customer auth check.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::get('customer_logged_in')) {
            return redirect()->route('customer.login');
        }

        return $next($request);
    }
}
