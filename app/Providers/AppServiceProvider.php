<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use App\Charts\SousIndicateurChart;
use App\Models\Indicateur;
use App\Models\Profil;
use App\Models\Programme;
use App\Models\Province;
use App\Models\Region;
use App\Models\SousIndicateur;
use App\Models\Structure;
use App\Observers\IndicateurObserver;
use App\Observers\ProfilObserver;
use App\Observers\ProgrammeObserver;
use App\Observers\ProvinceObserver;
use App\Observers\RegionObserver;
use App\Observers\SousIndicateurObserver;
use App\Observers\StructureObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Structure::observe(StructureObserver::class);
        Profil::observe(ProfilObserver::class);
        SousIndicateurChart::class;

        Schema::defaultStringLength(191);
    }
}
