<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    
    ];

    
    protected function tokensMatch($request) {
        $token = $request->session()->token();
        $header = null;
        if (\Request::ajax()) {
            $header = \Crypt::decrypt($_COOKIE['XSRF-TOKEN']);
        }
        return ($token === $request->input('_token')) ||
                ($header && ($token === $header));
    }

}
