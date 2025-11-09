<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Infrastructure\Persistence\Eloquent\Models\Product;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // إزالة images من البيانات المرسلة للـ Model
        // لأن الصور ستُحفظ عبر Observer أو manually
        unset($data['images']);

        return $data;
    }

    protected function afterCreate(): void
    {
        // الحصول على بيانات الصور من النموذج
        $images = $this->form->getState()['images'] ?? [];

        if (!empty($images)) {
            foreach ($images as $imagePath) {
                if ($imagePath && is_string($imagePath)) {
                    // الصور محفوظة بالفعل مع المسارات الكاملة من saveUploadedFileUsing
                    $this->record->images()->create(['path' => $imagePath]);
                }
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
