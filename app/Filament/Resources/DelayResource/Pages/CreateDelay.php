<?php

namespace App\Filament\Resources\DelayResource\Pages;

use App\Filament\Resources\DelayResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDelay extends CreateRecord
{
    protected static string $resource = DelayResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data);
    // }
}
