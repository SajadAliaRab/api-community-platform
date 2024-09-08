<?php
namespace App\Filament\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;

class RegisterProfile extends BaseRegister
{
protected function getForms():array
{
    return [
        'form'=>$this->form(
            $this->makeForm()
            ->schema([
                $this->getUserNameFormComponent(),
                $this->getFirstNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ])
                ->statePath('data'),
        ),
    ];
}
    protected function getUserNameFormComponent(): Component
    {
        return TextInput::make('userName')
            ->label('UserName')
            ->required()
            ->maxLength(255)
            ->autofocus();

    }
    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('fName')
            ->label('First Name')
            ->required()
            ->maxLength(255);
    }
}
