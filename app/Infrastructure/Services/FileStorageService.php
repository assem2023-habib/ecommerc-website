<?php

namespace App\Infrastructure\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileStorageService
{
    protected string $disk = 'public';

    /**
     * Upload file and return public URL (Storage::url)
     *
     * @param  UploadedFile $file
     * @param string $folder  // e.g 'categories' or 'products'
     * @param string // e.g '/storage/uploads/categories/abc.jpg
     */

    public function upload(UploadedFile $file, string $folder)
    {
        // you can add validation/resizing here if needed
        $path = $file->store("uploads/{$folder}", $this->disk);
        return Storage::disk($this->disk)->url($path);
    }
    /**
     * Delete by stored path or url
     *
     * @param  string|null $urlOrPath
     * @return void
     */
    public function delete(?string $urlOrPath): void
    {
        if (empty($urlOrPath))
            return;

        // if we stored full url (Storage::url), convert to relative path
        $baseUrl = Storage::disk($this->disk)->url('');
        if (str_starts_with($urlOrPath, $baseUrl))
            $relative = substr($urlOrPath, strlen($baseUrl));
        else
            // maybe the stored value is already relative path like 'uploads/...'
            $relative = ltrim(parse_url($urlOrPath, PHP_URL_PATH), '/');
        if (Storage::disk($this->disk)->exists($relative))
            Storage::disk($this->disk)->delete($relative);
    }
}
