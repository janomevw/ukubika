<?php

namespace App\Filament\Resources\ForemanResource\Pages;

use App\Filament\Resources\ForemanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageForemen extends ManageRecords
{
    protected static string $resource = ForemanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
