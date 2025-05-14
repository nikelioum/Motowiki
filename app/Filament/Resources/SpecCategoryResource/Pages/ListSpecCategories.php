<?php

namespace App\Filament\Resources\SpecCategoryResource\Pages;

use App\Filament\Resources\SpecCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecCategories extends ListRecords
{
    protected static string $resource = SpecCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
