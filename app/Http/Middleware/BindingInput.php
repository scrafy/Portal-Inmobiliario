<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\JsonMapper;

class BindingInput {

    public function handle($request, Closure $next, $model = null, $pathmodel = null) {
        if ($model == null) {
            return $next($request);
        }
        $model = resolve($pathmodel . "\\" . $model);
        $mapper = new JsonMapper();
        if ($request->header("content-type") === "application/x-www-form-urlencoded") {

            $model = $mapper->map(json_decode(json_encode($_POST)), $model);
        } else if ($request->isJson()) {

            $model = $mapper->map(json_decode(json_encode($request->input())), $model);
        }
        $request->route()->setParameter("model", $model);
        return $next($request);
    }

}
