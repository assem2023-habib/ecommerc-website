<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Schemas\ProductView;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('edit')
                ->label('Edit Product')
                ->icon(Heroicon::OutlinedPencil)
                ->url(fn () => ProductResource::getUrl('edit', ['record' => $this->record]))
                ->color('primary'),

            Action::make('back_to_list')
                ->label('Back to Products')
                ->icon(Heroicon::OutlinedArrowLeft)
                ->url(fn () => ProductResource::getUrl('index'))
                ->color('gray'),
        ];
    }

    public function getTitle(): string
    {
        return 'Product Details: ' . $this->record->name;
    }

    protected function getViewData(): array
    {
        return [
            'product' => $this->record,
        ];
    }

    public function getFormSchema(): array
    {
        // Ensure relations are loaded
        $this->record->load(['category', 'images']);

        // Prepare data with relations included
        $data = array_merge($this->record->toArray(), [
            'category' => $this->record->category ? $this->record->category->toArray() : null,
            'images' => $this->record->images ? $this->record->images->toArray() : []
        ]);

        return ProductView::configure(
            Schema::make('product')->state($data),
            $this->record
        )->getComponents();
    }
}
