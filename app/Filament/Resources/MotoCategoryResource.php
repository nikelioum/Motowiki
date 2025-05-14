<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotoCategoryResource\Pages;
use App\Filament\Resources\MotoCategoryResource\RelationManagers;
use App\Models\MotoCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Tables\Filters\SelectFilter;

class MotoCategoryResource extends Resource
{
    protected static ?string $model = MotoCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(
                        MotoCategory::whereNotNull('title') // Filter out categories with null names
                        ->pluck('title', 'id')
                    )
                    ->nullable() // Allows null if no parent is selected
                    ->searchable(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->debounce(1000)
                ,
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('meta_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('meta_image')
                    ->image(),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->integer()
                    ->default(0),
                Forms\Components\Toggle::make('is_show')
                    ->required()
                    ->default(true),
                Forms\Components\Toggle::make('is_popular')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent_id')
                    ->label('Parent Category') // Label for the column
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return $record->parent ? $record->parent->title : 'No Parent'; // Display parent's title (or a default text if no parent)
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('meta_image'),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
                SelectFilter::make('parent_id')
                    ->label('Filter by Parent Category')
                    ->options(
                        MotoCategory::pluck('title', 'id')->toArray()
                    ) // This will get the title and ID from all categories for filtering
                    ->attribute('parent_id')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMotoCategories::route('/'),
            'create' => Pages\CreateMotoCategory::route('/create'),
            'edit' => Pages\EditMotoCategory::route('/{record}/edit'),
        ];
    }
}
