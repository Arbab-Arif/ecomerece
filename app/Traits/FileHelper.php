<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait FileHelper
{
    /**
     * @param  null  $model
     * @return string
     */
    public function saveFileAndGetName(UploadedFile $file, $model = null)
    {
        return $file->store($this->getFolderName($model));
    }

    public function updateFileAndGetName(UploadedFile $file, $lastFile, $model = null)
    {
        return $this->deleteFile($lastFile)
            ->saveFileAndGetName($file, $model);
    }

    public function deleteFile($file)
    {
        if ($file && $file !== '' && Storage::exists($file)) {
            Storage::delete($file);
        }

        return $this;
    }

    protected function getFolderName($model = null): Stringable
    {
        $class = $model ?: get_class();

        return Str::of($class)->afterLast('\\')->before('Controller')->kebab()
            ->slug('_')->plural();
    }

    protected function getQuality($size): int
    {
        $size = $this->bytesToKB($size);

        if ($size >= (1024 * 10)) {
            $quality = 20;
        } elseif ($size >= (1024 * 5)) {
            $quality = 40;
        } elseif ($size >= (1024 * 3)) {
            $quality = 60;
        } elseif ($size >= (1024)) {
            $quality = 80;
        } else {
            $quality = 99;
        }

        return $quality;
    }

    protected function bytesToKB($size): int
    {
        $units = ['B', 'KB'];
        $formattedSize = $size;

        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
            $formattedSize = round($size, 2);
        }

        return $formattedSize;
    }

    public function getImagePath($key, $size = 'lg_')
    {
        $file = $this->$key;
        if (Str::contains($file, 'https://')) {
            return $file;
        }
        if (is_null($file) || $file === '') {
            return $this->getNoImagePath();
        }

        // Check if the file exists in the public directory
        if (file_exists(public_path($file))) {
            return asset($file);
        }

        // Check if the default filesystem is S3
        if (config('filesystems.default') == 's3') {
            return config('filesystems.disks.s3.url').'/'.$file;
        }

        // Default to the storage path
        return asset('storage/'.$file);
    }

    protected function getNoImagePath(): string
    {
        return 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
    }

    public function getImageByName($name)
    {
        if (! empty($name)) {
            if (config('filesystems.default') == 's3') {
                return config('filesystems.disks.s3.url').'/FileHelper.php';
            }

            return url("storage/$name");
        }

        return $this->getNoImagePath();
    }

    // video name
    public function saveVideoFileAndGetName(UploadedFile $file, $model = null)
    {
        // Determine the storage folder for the file
        $path = $file->store($this->getFolderName($model), 'public');

        // Return the file's path relative to the storage directory
        return $path;
    }

    public function updateVideoFileAndGetName(UploadedFile $file, $lastFile, $model = null)
    {
        return $this->deleteFile($lastFile)
            ->saveVideoFileAndGetName($file, $model);
    }
}
