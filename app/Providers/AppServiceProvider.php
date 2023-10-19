<?php

namespace App\Providers;

use Filament\Pages\Actions\Modal\Actions\Action;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Action::configureUsing(function(Action $action){
            $action->outlined();
        });

        // Action::configureUsing(function(Action $action){
        //     $action->outlined();
        // });
        // FilamentView::registerRenderHook(
        //     'panels::topbar.start',
        //     // fn (): String => 'find a way to call the breadcrumbs.....',
        //     fn () => Blade::render('<x-filament::breadcrumbs :breadcrumbs="[\'Home\']"/>'),
        // );
    }
}
