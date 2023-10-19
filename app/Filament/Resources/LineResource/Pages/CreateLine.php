<?php

namespace App\Filament\Resources\LineResource\Pages;

use App\Filament\Resources\LineResource;
use Filament\Actions;;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateLine extends CreateRecord
{
    protected static string $resource = LineResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $string = $data['name'];
        $line_key = $data['key'];

        if (!$line_key){
            $first_characters = [];
            foreach (explode(" ", $string) as $word) {
            $first_characters[] = $word[0];
            }

        $data['key'] = Str::lower(implode("", $first_characters));
        }

        return $data;
    }
}
