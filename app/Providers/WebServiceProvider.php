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
use App\BussinesModel\Services\Web\FooterControllerOperations;
use App\BussinesModel\Services\Web\HomeControllerOperations;
use App\BussinesModel\Services\Web\LettingControllerOperations;
use App\Http\Controllers\Web\LettingController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\FooterController;

class WebServiceProvider extends ServiceProvider {

    public function boot() {

        $this->app->Resolving(LettingController::class, function($lettings_operations, $app) {
            $app->when(LettingController::class)->needs(ILettingOperations::class)->give(function() {

                return new LettingControllerOperations();
            });
        });
    }

    public function register() {

        $this->app->when(LettingController::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(LettingController::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });

        $this->app->when(HomeController::class)->needs(IHomeOperations::class)->give(function() {

            return new HomeControllerOperations();
        });

        $this->app->when(LettingControllerOperations::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(LettingControllerOperations::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });

        $this->app->bind(ILettingOperations::class, LettingControllerOperations::class);

        $this->app->when(FooterController::class)->needs(IFooterOperations::class)->give(function() {

            return new FooterControllerOperations();
        });
    }

}
