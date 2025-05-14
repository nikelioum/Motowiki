<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecResource\Pages;
use App\Filament\Resources\SpecResource\RelationManagers;
use App\Models\Spec;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\SpecCategory;
use App\Enum\SpecAttributeType;
use Filament\Tables\Filters\SelectFilter;

class SpecResource extends Resource
{
    protected static ?string $model = Spec::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('spec_category_id')
                    ->label('Spec Category')
                    ->options(
                        SpecCategory::pluck('name', 'id') // Assumes 'name' field in SpecCategory model
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Spec Type')
                    ->options(
                        collect(SpecAttributeType::cases())->pluck('name', 'value')->toArray()
                    ) // Generating the options from enum cases
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('spec_category_id')
                    ->numeric()
                    ->getStateUsing(function ($record) {
                        return $record->specCategory ? $record->specCategory->name : 'No Category'; // Assuming 'name' is the field you want to display
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('spec_category_id')
                    ->label('Filter by Spec Category') // Label for the filter
                    ->options(
                        SpecCategory::pluck('name', 'id')->toArray() // Fetch all spec category names and their IDs
                    ) // Populating the filter with spec category names and their IDs
                    ->attribute('spec_category_id'), // Filter by 'spec_category_id' field
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecs::route('/'),
            'create' => Pages\CreateSpec::route('/create'),
            'edit' => Pages\EditSpec::route('/{record}/edit'),
        ];
    }
}
