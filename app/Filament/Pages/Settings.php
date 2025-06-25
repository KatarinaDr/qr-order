<?php
/*
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

    public $company_name;
    public $session;

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::get('company_name', 'Lokal'),
            'session' => Setting::get('session', 300),
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
                            Forms\Components\TextInput::make('session')
                                ->label('Trajanje sesije (minute)')
                                ->prefixIcon('heroicon-o-clock')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->helperText('Unesite trajanje sesije u minutama (npr. 5 za 5 minuta).'),
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

        $this->form->fill($data);
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role && auth()->user()->role->name === 'manager' && auth()->user()->hasPermission('article_table_admin');
    }

}*/
