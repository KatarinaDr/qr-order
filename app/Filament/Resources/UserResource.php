<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('licence_key')
                    ->label('Licence Key')
                    ->maxLength(5)
                    ->minLength(5)
                    ->helperText('Unesite licencni ključ menadžera'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Ime')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email'),

                TextColumn::make('license_key')
                    ->label('Licencni kljuc'),

                TextColumn::make('role.name')
                    ->label('Role'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status')
                    ->onIcon('heroicon-m-user')->onColor('success')
                    ->offIcon('heroicon-m-user')->offColor('danger')
                    ->inline(false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role && auth()->user()->role->name === 'super_admin';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('role', function ($query) {
                $query->where('name', '!=', 'super_admin');
            });
    }
}
