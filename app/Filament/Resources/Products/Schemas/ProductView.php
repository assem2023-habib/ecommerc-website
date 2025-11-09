<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ProductView
{
    public static function configure(Schema $schema, $record = null): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->schema([
                        TextInput::make('name')
                            ->disabled()
                            ->columnSpan(['md' => 1]),

                        TextInput::make('price')
                            ->disabled()
                            ->prefix('$')
                            ->columnSpan(['md' => 1]),

                        TextInput::make('stock')
                            ->disabled()
                            ->columnSpan(['md' => 1]),

                        TextInput::make('discount')
                            ->disabled()
                            ->prefix('%')
                            ->columnSpan(['md' => 1]),

                        Textarea::make('description')
                            ->disabled()
                            ->columnSpanFull()
                            ->rows(3),

                        TextInput::make('short_description')
                            ->disabled()
                            ->columnSpanFull(),

                        TextInput::make('category.name')
                            ->label('Category')
                            ->disabled()
                            ->columnSpan(['md' => 1]),

                        Toggle::make('is_show')
                            ->disabled()
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2]),

                Section::make('Product Images')
                    ->schema([
                        Repeater::make('images')
                            ->label('All Product Images')
                            ->schema([
                                Placeholder::make('image_display')
                                    ->label('Image')
                                    ->content(function ($get) {
                                        $path = $get('path');

                                        if ($path) {
                                            $url = Storage::url($path);

                                            return <<<HTML
                                                <div class="text-center">
                                                    <img src="{$url}" alt="Product Image"
                                                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                        onclick="window.open('{$url}', '_blank')">
                                                    <br>
                                                    <small class="text-gray-500 mt-2 block">Click to view full size</small>
                                                </div>
                                            HTML;
                                        }

                                        return 'No image available';
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->disabled()
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->helperText('All images associated with this product. Click on images to view them in full size.')
                            ->default(function () use ($record) {
                                return $record ? $record->images->toArray() : [];
                            })
                            ->getState(function () use ($record) {
                                return $record ? $record->images->toArray() : [];
                            }),
                    ])
                    ->columns(1)
                    ->collapsible()
                    ->collapsed(false),
            ]);
    }
}
