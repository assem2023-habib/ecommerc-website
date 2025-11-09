<?php

namespace App\Filament\Resources\Products\Tables;

use App\Infrastructure\Persistence\Eloquent\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Image')
                    ->getStateUsing(function (Product $record) {
                        $firstImage = $record->images->first();
                        return $firstImage ? $firstImage->path : null;
                    })
                    ->circular()
                    ->defaultImageUrl('/images/placeholder.png'),
                TextColumn::make('images_count')
                    ->label('Images')
                    ->getStateUsing(function (Product $record) {
                        return $record->images->count() . ' images';
                    })
                    ->badge()
                    ->color('success'),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_show')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
