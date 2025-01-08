<?php

namespace App\Providers\Filament;


use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\LoginCustom;
use App\Filament\Pages\Auth\RegisterProfile;
use Faker\ChanceGenerator;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Navigation\MenuItem;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;



class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->login(LoginCustom::class)
            ->registration(RegisterProfile::class)
            ->profile(EditProfile::class)
            ->colors([
                'primary' => Color::Lime,
                'gray' => Color::Gray,
            ])
            ->userMenuItems([
                'Password' => MenuItem::make()
                    ->label('Change Your Password')
                    ->icon('heroicon-m-key')


            ])
            ->navigationItems([
                NavigationItem::make('Back to Community')
                    ->url('https://community.sajad.uk',)
                    ->icon('heroicon-m-home')
                    ->sort(-3)
                    ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,

            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
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
           -> defaultThemeMode(ThemeMode::Dark)
            ->sidebarWidth('15rem')
            ->brandName('Community-Platform')
            ->brandLogo(asset('/uploads/logo.png'))
            ->brandLogoHeight('4rem')
            ->favicon(asset('/uploads/favicon.ico'));
    }
}
