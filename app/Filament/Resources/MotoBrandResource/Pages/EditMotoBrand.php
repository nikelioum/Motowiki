<?php

namespace App\Filament\Resources\MotoBrandResource\Pages;

use App\Filament\Resources\MotoBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotoBrand extends EditRecord
{
    protected static string $resource = MotoBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
