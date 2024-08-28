<?php

namespace App\Filament\Resources\RtableResource\Pages;

use App\Filament\Resources\RtableResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewQrCode extends ViewRecord
{
    protected static string $resource = RtableResource::class;

    protected static string $view = 'filament.resource.rtable-resource.pages.view-qr-code';

    protected function getActions(): array
    {
        return [];
    }
}
