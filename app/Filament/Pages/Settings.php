<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Models\Setting;
use App\Models\Article;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $title = 'Settings';
    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->loadFormData();
    }

    protected function loadFormData(): void
    {
        $this->form->fill([
            'company_name' => Setting::get('company_name'),
            'email' => Setting::get('email'),
            'phone' => Setting::get('phone'),
            'articles' => [],
        ]);
    }


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Tabs::make('Postavke')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('About')
                        ->schema([
                            Forms\Components\TextInput::make('company_name')
                                ->label('Naziv lokala')
                                ->prefixIcon('heroicon-o-home-modern')
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->label('Trajanje sesije')
                                ->prefixIcon('heroicon-o-clock')
                                ->required(),
                            Forms\Components\Section::make('Pozadina')
                                ->schema([
                                    Forms\Components\TextInput::make('color')
                                        ->label('Boja pozadine')
                                        ->prefixIcon('heroicon-o-photo'),
                                    Forms\Components\FileUpload::make('photo')
                                        ->label('Slika pozadine')
                                        ->image(),
                                ]),
                        ]),
                ]),
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('Uspjesno sacuvano')
            ->body('Postavke su sačuvane.')
            ->success()
            ->send();

        $this->form->fill();
    }


}
