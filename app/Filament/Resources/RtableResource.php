<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RtableResource\Pages;
use App\Filament\Resources\RtableResource\RelationManagers;
use App\Models\Rtable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;

class RtableResource extends Resource
{
    protected static ?string $model = Rtable::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return auth()->user()->hasPermission('article_table_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('web_page')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('web_page')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->onIcon('heroicon-m-user')
                    ->offIcon('heroicon-m-user')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(),
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

                Tables\Actions\Action::make('View QR Code') 
                    ->label('QR code')
                    //->color('success')
                    ->icon('heroicon-o-qr-code')
                    ->url(fn (Rtable $record) => static::getUrl('qr-code',[$record])),
                    //->openUrlInNewTab(), 

                Tables\Actions\Action::make('Download') 
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-o-document')
                    ->action(function (Rtable $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHTML(
                                Blade::render('filament.resource.rtable-resource.pages.pdf', ['record' => $record])
                            )->stream();
                        }, 'QR za sto: ' .$record->number . '.pdf');
                    }),

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
            'index' => Pages\ListRtables::route('/'),
            'create' => Pages\CreateRtable::route('/create'),
            'edit' => Pages\EditRtable::route('/{record}/edit'),
            'qr-code' => Pages\ViewQrCode::route('/{record}/qr-code'),
        ];
    }
}
