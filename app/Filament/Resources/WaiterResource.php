<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaiterResource\Pages;
use App\Models\User;
use App\Models\Waiter;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;

class WaiterResource extends Resource
{
    protected static ?string $model = Waiter::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Konobari';
    protected static ?string $pluralLabel = 'Konobari';
    protected static ?string $modelLabel = 'Konobar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Waiter::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ime')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Datum registracije')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaiters::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role && auth()->user()->role->name === 'manager' && auth()->user()->hasPermission('article_table_admin');
    }
}



