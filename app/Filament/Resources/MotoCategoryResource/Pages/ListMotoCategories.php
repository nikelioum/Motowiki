<?php

namespace App\Filament\Resources\MotoCategoryResource\Pages;

use App\Filament\Resources\MotoCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotoCategories extends ListRecords
{
    protected static string $resource = MotoCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
