<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\FacadesImplementation\Strings;

class FacadesServiceProvider extends ServiceProvider {

    public function boot() {
        
    }

    public function register() {

        \App::bind("strings", function() {
            return new Strings();
        });
       
    }

}
