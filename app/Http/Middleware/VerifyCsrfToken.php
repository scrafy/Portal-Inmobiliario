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
            //
    ];

    //enable in production
    protected function tokensMatch($request) {
        $token = $request->session()->token();

        $header = $request->header('X-XSRF-TOKEN');

        return ($token===$request->input('_token')) ||
                ($header && ($token===$header));
    }

}
