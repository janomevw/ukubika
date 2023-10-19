<?php

namespace App\Providers\Filament;

use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        Action::configureUsing(function (Action $action):void
        {
            $action->outlined();
        });

        return $panel
            // ->spa()
            ->default()
            ->id('safalsteel')
            ->path('safalsteel')
            ->login()
            ->breadcrumbs(false)
            ->sidebarFullyCollapsibleOnDesktop()
            // ->sidebarCollapsibleOnDesktop()
            // ->maxContentWidth('screen-md')
            ->font('Poppins')
            ->colors([
                // 'primary' => Color::Amber,
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Indigo,
                'primary' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'all' => Color::Red,
                'crm' => Color::Blue,
                'mcl' => Color::Green,
                'ccl' => Color::Amber,
                'report' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            // ->widgets([
            //     Widgets\AccountWidget::class,
            //     Widgets\FilamentInfoWidget::class,
            // ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
            // ->renderHook(
            //     'panels::topbar.start',
            //     fn(): String => Blade::render('<x-filament::breadcrumbs :breadcrumbs="[\'Will still find something to put here....\']"/>')
            //     // fn() => view('test')
            // );
    }
}
