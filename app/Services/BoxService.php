<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;

class BoxService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('uploads/box/' . $model->file))) {
                File::delete(public_path('uploads/box/' . $model->file));
            }
            if (File::isFile(public_path('uploads/box/webp/' . $model->file_webp))) {
                File::delete(public_path('uploads/box/webp/' . $model->file_webp));
            }
        }

        $name_file = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $name = date('His') . '_' . Str::slug($name_file) . '.' . $file->getClientOriginalExtension();
        $name_webp = date('His') . '_' . Str::slug($name_file) . '.webp';

        $file->storeAs('box', $name, 'public_uploads');
        $filepath = public_path('uploads/box/' . $name);
        $filepath_webp = public_path('uploads/box/webp/' . $name_webp);

        ImageManager::make($filepath)
            ->resize(
                config('images.box.width'),
                config('images.box.height'),
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($filepath);
        ImageManager::make($filepath)->encode('webp', 90)->save($filepath_webp);

        $model->update([
            'file' => $name,
            'file_webp' => $name_webp
        ]);
    }
}
