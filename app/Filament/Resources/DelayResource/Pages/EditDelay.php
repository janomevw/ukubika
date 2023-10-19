<?php

namespace App\Filament\Resources\DelayResource\Pages;

use App\Filament\Resources\DelayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDelay extends EditRecord
{
    protected static string $resource = DelayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
