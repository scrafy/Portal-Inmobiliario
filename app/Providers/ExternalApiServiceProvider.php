<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainAreaOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBranchOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainCountyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainDiaryOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPhotoOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainSalesOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainStaffOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBookOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainPropertyOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainAreaOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainBranchOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainCountyOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainDiaryOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainLettingOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainPhotoOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainSalesOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainStaffOperations;
use App\BussinesModel\Services\ExternalApi\MainOperations\ExternalApiMainBookOperations;
use App\Http\Controllers\ExternalApi\AreaController;
use App\Http\Controllers\ExternalApi\BranchController;
use App\Http\Controllers\ExternalApi\CountyController;
use App\Http\Controllers\ExternalApi\DiaryController;
use App\Http\Controllers\ExternalApi\LettingsController;
use App\Http\Controllers\ExternalApi\PhotoController;
use App\Http\Controllers\ExternalApi\PropertyController;
use App\Http\Controllers\ExternalApi\SalesController;
use App\Http\Controllers\ExternalApi\StaffController;
use App\Http\Controllers\ExternalApi\BookController;
use App\Http\Controllers\ExternalApi\UpdateDBController;
use App\Http\Controllers\Web\LettingController;

class ExternalApiServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->when(AreaController::class)->needs(IExternalApiMainAreaOperations::class)->give(function() {

            return new ExternalApiMainAreaOperations();
        });

        $this->app->when(BranchController::class)->needs(IExternalApiMainBranchOperations::class)->give(function() {

            return new ExternalApiMainBranchOperations();
        });

        $this->app->when(CountyController::class)->needs(IExternalApiMainCountyOperations::class)->give(function() {

            return new ExternalApiMainCountyOperations();
        });

        $this->app->when(DiaryController::class)->needs(IExternalApiMainDiaryOperations::class)->give(function() {

            return new ExternalApiMainDiaryOperations();
        });

        $this->app->when(LettingsController::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });

        $this->app->when(PhotoController::class)->needs(IExternalApiMainPhotoOperations::class)->give(function() {

            return new ExternalApiMainPhotoOperations();
        });

        $this->app->when(PropertyController::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(SalesController::class)->needs(IExternalApiMainSalesOperations::class)->give(function() {

            return new ExternalApiMainSalesOperations();
        });

        $this->app->when(StaffController::class)->needs(IExternalApiMainStaffOperations::class)->give(function() {

            return new ExternalApiMainStaffOperations();
        });

        $this->app->when(BookController::class)->needs(IExternalApiMainBookOperations::class)->give(function() {

            return new ExternalApiMainBookOperations();
        });

        $this->app->when(UpdateDBController::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(UpdateDBController::class)->needs(IExternalApiMainBranchOperations::class)->give(function() {

            return new ExternalApiMainBranchOperations();
        });

        $this->app->when(UpdateDBController::class)->needs(IExternalApiMainPhotoOperations::class)->give(function() {

            return new ExternalApiMainPhotoOperations();
        });

        $this->app->when(UpdateDBController::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });

        $this->app->when(UpdateDBController::class)->needs(IExternalApiMainAreaOperations::class)->give(function() {

            return new ExternalApiMainAreaOperations();
        });

        /* HAY QUE SACARLOS DE AQUI Y PONERLOS EN OTRO FICHERO PROVIDER */

        $this->app->when(LettingController::class)->needs(IExternalApiMainPropertyOperations::class)->give(function() {

            return new ExternalApiMainPropertyOperations();
        });

        $this->app->when(LettingController::class)->needs(IExternalApiMainLettingOperations::class)->give(function() {

            return new ExternalApiMainLettingOperations();
        });
    }

}
