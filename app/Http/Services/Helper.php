<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;
use Orchid\Platform\Events\UploadedFileEvent;

class Helper
{
     public static function uploadFile(UploadedFile $file, string $disk = 'public', string $group = null, string $path = null)
     {
        $file = resolve(File::class, [
            'file'  => $file,
            'disk'  => $disk,
            'group' => $group,
        ]);

        if ($path) {
            $file->path($path);
        }

        $model = $file->load();

        $model->url = $model->url();

        event(new UploadedFileEvent($model));

        return $model;
     }
}
