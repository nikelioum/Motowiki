<?php

namespace App\Filament\Resources\SpecCategoryResource\Pages;

use App\Filament\Resources\SpecCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecCategory extends EditRecord
{
    protected static string $resource = SpecCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
