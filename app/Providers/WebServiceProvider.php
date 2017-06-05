<?php

namespace App\Providers;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainPropertyOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainLettingOperations;
use Illuminate\Support\ServiceProvider;
use App\BussinesModel\Interfaces\Web\IHomeOperations;
use App\BussinesModel\Interfaces\Web\ILettingOperations;
use App\BussinesModel\Interfaces\Web\IFooterOperations;
use App\BussinesModel\Interfaces\Common\ICacheOperations;
use App\BussinesModel\Services\Web\FooterControllerOperations;
use App\BussinesModel\Services\Web\HomeControllerOperations;
use App\BussinesModel\Services\Web\LettingControllerOperations;
use App\BussinesModel\Services\Common\CacheOperations;

class WebServiceProvider extends ServiceProvider {

    public function boot() {
 
    }

    public function register() {

        $this->app->when(LettingControllerOperations::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(LettingControllerOperations::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });
        
        /* BINDS */
        $this->app->bind(ICacheOperations::class, CacheOperations::class);
        $this->app->bind(IHomeOperations::class, HomeControllerOperations::class);
        $this->app->bind(ILettingOperations::class, LettingControllerOperations::class);
        $this->app->bind(IFooterOperations::class, FooterControllerOperations::class);
        
        
       
    }
}
