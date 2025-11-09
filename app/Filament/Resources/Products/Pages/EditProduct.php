<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // إزالة images من البيانات المرسلة للـ Model
        unset($data['images']);

        return $data;
    }

    protected function afterSave(): void
    {
        $newImages = $this->form->getState()['images'] ?? [];

        if (!empty($newImages)) {
            // $this->record->images()->delete();
            foreach ($newImages as $imagePath) {
                if ($imagePath) {
                    $this->record->images()->create(['path' => $imagePath]);
                }
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
