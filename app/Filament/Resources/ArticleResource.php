<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Support\RawJs;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static ?bool $imageStatus = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('About Article')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->stripCharacters(',')
                            ->prefix('KM')
                            ->default(0.00)
                            ->minValue(0.1)
                            ->maxValue(99999.99),

                        Forms\Components\Repeater::make('tags')
                            ->label('Extra Ingredients')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Ingredient')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columnSpanFull()
                            ->default([])
                            ->addActionLabel('Add Ingredient')
                            ->columns(1),

                        Forms\Components\Toggle::make('is_active')
                            ->inline(false)
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                    ])->columnSpan(2)
                      ->columns(2),
                Section::make('Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->disk('public')
                            ->directory('articles')
                            ->preserveFilenames(),
                    ])->columns([2]),
                Section::make('Printers')
                    ->schema([
                        Select::make('printer')
                        ->label('Printers for article:')
                        ->multiple()
                        ->relationship('printer','name')
                        ->preload(),
                    ])->columnSpan(1),
                Section::make('Category')
                    ->schema([
                        Select::make('category')
                        ->label('Categories for article:')
                        ->multiple()
                        ->relationship('category','name')
                        ->preload(),
                    ])->columnSpan(1),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->maxLength(60000)
                    ->hint('Description of dish')
                    ->hintColor('primary')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(35)
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->suffix(' KM')
                    //->money()
                    ->sortable(),
                /*Tables\Columns\ImageColumn::make('image_url')
                    //->disabledOn('edit')
                    ->disableClick(true)
                    ->label('image'),*/
                Tables\Columns\TagsColumn::make('category.name'),
                //Tables\Columns\TagsColumn::make('tags'),
                Tables\Columns\TagsColumn::make('printer.name')
                ->default(''),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->onIcon('heroicon-m-user')
                    ->offIcon('heroicon-m-user')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false),
                    //->boolean(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role && auth()->user()->role->name === 'manager' && auth()->user()->hasPermission('article_table_admin');
    }
}
