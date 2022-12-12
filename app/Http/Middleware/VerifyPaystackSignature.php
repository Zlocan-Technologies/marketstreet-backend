<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyPaystackSignature
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
        if(!$request->hasHeader('x-paystack-signature')):
            exit();
        endif;

        $input = json_encode($request->all());
        if($request->header('x-paystack-signature') !== 
        hash_hmac('sha512', $input, env('PAYSTACK_SECRET', ''))):
            exit();
        endif;

        return $next($request);
    }
}
