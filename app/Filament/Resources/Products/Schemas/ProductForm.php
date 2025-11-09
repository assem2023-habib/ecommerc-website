<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Infrastructure\Services\FileStorageService;
use Filament\Forms\Components\FileUpload as FilamentFileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema as FilamentSchema;

class ProductForm
{
    public static function configure(FilamentSchema $schema): FilamentSchema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('short_description')
                    ->default(null),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->prefix('%')
                    ->default(0),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Toggle::make('is_show')
                    ->required(),
                FilamentFileUpload::make('images')
                    ->label('Product Images')
                    ->multiple()
                    ->image()
                    ->maxSize(2048)
                    ->directory('uploads/products')
                    ->reorderable()
                    ->preserveFilenames(false)
                    ->downloadable()
                    ->columnSpanFull()
                    ->helperText('Upload one or more product images.')
                    ->saveUploadedFileUsing(function ($file, $get, $set) {
                        $fileStorage = new FileStorageService();
                        return $fileStorage->upload($file, 'products');
                    }),
            ]);
    }
}
