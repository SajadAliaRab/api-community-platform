<?php
Namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Log;

class LoginCustom extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.login-custom';

}
