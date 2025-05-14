<?php

namespace App\Filament\Resources\MotoBrandResource\Pages;

use App\Filament\Resources\MotoBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotoBrands extends ListRecords
{
    protected static string $resource = MotoBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
