<?php

namespace App\Filament\Pages\Auth;

use App\Models\UserDetail;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Http\RedirectResponse;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
              FileUpload::make('image')
                  ->avatar()
                  ->image()
                  ->disk('public')
                  ->directory('avatars')
                  ->maxSize(2048)
                  ->imageEditor()
                  ->imageEditorAspectRatios(['1:1'])
                  ->circleCropper()
                  ->label('Profile Picture'),
              TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
              TextInput::make('userName')
                    ->required()
                   ->maxLength(255),
              Select::make('title')
                    ->options([
                        'mr'=>'Mr',
                        'mrs'=>'Mrs',
                        'miss'=>'Miss',
                        'other'=>'Other'
                    ]),
              TextInput::make('fName')
                  ->label('First Name')
                   ->required()
                   ->maxLength(255),
              TextInput::make('lName')
                    ->label('Last Name')
                    ->maxLength(255),
             TextInput::make('website')
                ->label('Website')
                 ->prefix('https://'),
             PhoneInput::make('mobile'),
             TextInput::make('point')
                ->disabled()
                ->maxWidth('4px'),


            ]);

    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $userDetail = $this->getUser()->user_detail;

        if ($userDetail) {
            $data['image'] = $userDetail->image;
            $data['title'] = $userDetail->title;
            $data['title'] = $userDetail->title;
            $data['website']=$userDetail->website;
            $data['mobile']=$userDetail->mobile;
            $data['point']=$userDetail->point;
        }

        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = $this->getUser();

        $userDetail = $user->user_detail;
        if ($userDetail) {
            $data['image'] = $data['image'] ?? $userDetail->image;
            $userDetail->update([
                'image' => $data['image'],
                'title' => $data['title'],
                'website'=>$data['website'],
                'mobile'=>$data['mobile'],
            ]);
        }


        return $data;
    }
protected function getRedirectUrl(): ?string
{
    return url('/admin');
}
}
