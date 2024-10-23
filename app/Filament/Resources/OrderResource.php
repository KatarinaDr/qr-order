<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer')
                    ->maxLength(255),
                Forms\Components\TextInput::make('table')
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('table')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                // ...
                Tables\Actions\Action::make('Download') 
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-o-document')
                    ->action(fn() => static::downloadTxt()),
                    

            ]);
    }

    public static function downloadTxt()
    {
        return response()->streamDownload(function () {
            // Stream the .txt content dynamically
            $datas = Order::select('id', 'customer', 'table', 'total')
                        ->orderBy('id', 'desc')
                        ->take(10)
                        ->get();

            // Build the text content line by line
            $txtContent = "";
            foreach ($datas as $data) {
                $txtContent .= $data->id . '|' . $data->customer . '|' . $data->table . '|' . $data->total . PHP_EOL;
            }

            // Echo the text content as it is streamed
            echo $txtContent;
        }, 'user_data.txt'); // Name of the file
    }

    protected function getActions(): array
{
    return [
        Action::make('settings')->action('openSettingsModal'),
    ];
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
