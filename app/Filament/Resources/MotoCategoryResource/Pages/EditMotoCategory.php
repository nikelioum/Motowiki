<?php

namespace App\Filament\Resources\MotoCategoryResource\Pages;

use App\Filament\Resources\MotoCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotoCategory extends EditRecord
{
    protected static string $resource = MotoCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
