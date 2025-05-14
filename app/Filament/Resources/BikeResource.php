<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BikeResource\Pages;
use App\Filament\Resources\BikeResource\RelationManagers;
use App\Models\Bike;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use App\Models\MotoBrand;
use App\Models\MotoCategory;

class BikeResource extends Resource
{
    protected static ?string $model = Bike::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->debounce(1000),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('brand_id')
                    ->label('Brand')
                    ->options(MotoBrand::all()->pluck('name', 'id')) // assuming `title` is the name column in MotoBrand
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(MotoCategory::all()->pluck('title', 'id')) // assuming `title` is the name column in MotoCategory
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->default(null)
                    ->prefix('€'),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('meta_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('meta_image')
                    ->image(),
                Forms\Components\Toggle::make('status')
                    ->default(true)
                    ->required(),

                // 🆕 Repeater for Bike Specifications
                Forms\Components\Repeater::make('specifications')
                    ->label('Bike Specifications')
                    ->relationship('specValues') // must match Bike::specValues() relationship method
                    ->schema([
                        Forms\Components\Select::make('spec_id')
                            ->label('Specification')
                            ->options(\App\Models\Spec::pluck('label', 'id')->toArray())
                            ->required(),
                        Forms\Components\TextInput::make('value')
                            ->required(),
                    ])
                    ->defaultItems(0)
                    ->createItemButtonLabel('Add Specification')
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . ' €')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
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
                //
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
            'index' => Pages\ListBikes::route('/'),
            'create' => Pages\CreateBike::route('/create'),
            'edit' => Pages\EditBike::route('/{record}/edit'),
        ];
    }
}
