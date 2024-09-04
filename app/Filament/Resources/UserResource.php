<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && auth()->user()->isAdmin();
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('userName')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('fName')
                    ->label('First Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lName')
                    ->label('Last Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->hiddenOn('edit'),
                Forms\Components\Select::make('type')
                    ->label('Role')
                    ->required()
                    ->options([
                        'user' => 'User',
                        'expert' => 'Expert',
                        'admin' => 'Admin',
                    ])
                    ->default('user'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('userName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fName')
                    ->label('First Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lName')
                    ->label('Last Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Role')
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'warning',
                        'export' => 'info',
                        'user' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->label('Role')
                ->options([
                    'user' => 'User',
                    'expert' => 'Expert',
                    'admin' => 'Admin',
                ]),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('details')
                    ->label('Details')
                    ->modalHeading('User Details')
                    ->modalContent(fn (User $record) => view('filament.pages.user-detail-page', ['user' => $record]))
                    ->modalSubmitAction(false)
                    ->icon('heroicon-o-information-circle')
                    ->color('warning'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),


        ];
    }

}
