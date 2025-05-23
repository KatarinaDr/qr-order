<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::where('license_key', $data['license_key'])->first();

        if (!$user) {
            Notification::make()
                ->title('Greška')
                ->body('Korisnik sa ovim licencnim ključem ne postoji.')
                ->danger()
                ->send();

            $this->halt();
        }

        $user->update([
            'is_active' => true,
            'can_access_dashboard' => true,
        ]);

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
