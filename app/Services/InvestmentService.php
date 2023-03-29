<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Plan;
use Intervention\Image\ImageManagerStatic as ImageManager;

class InvestmentService
{
    public function uploadThumb(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('investment/thumbs/' . $model->file_thumb))) {
                File::delete(public_path('investment/thumbs/' . $model->file_thumb));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('thumbs', $name, 'investment_uploads');

        $filepath = public_path('investment/thumbs/' . $name);
        Image::make($filepath)
            ->fit(
                config('images.investment_thumb.width'),
                config('images.investment_thumb.height')
            )
            ->save($filepath);

        $model->update(['file_thumb' => $name]);
    }

    public function uploadPlan(object $model, UploadedFile $file)
    {

        if ($model->plan()->exists()) {
            if (File::isFile(public_path('investment/plan/' . $model->plan()->first()->file))) {
                File::delete(public_path('investment/plan/' . $model->plan()->first()->file));
            }
            if (File::isFile(public_path('investment/plan/webp/' . $model->plan()->first()->file_webp))) {
                File::delete(public_path('investment/plan/webp/' . $model->plan()->first()->file_webp));
            }
        }

        $name = date('His') . '_' . Str::slug($model->name) . '.' . $file->getClientOriginalExtension();
        $name_webp = date('His') . '_' . Str::slug($model->name) . '.webp';

        $file->storeAs('plan', $name, 'investment_uploads');
        $filepath = public_path('investment/plan/' . $name);
        $filepath_webp = public_path('investment/plan/webp/' . $name_webp);

        Image::make($filepath)->resize(
            config('images.plan.width'),
            config('images.plan.height'),
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($filepath);

        ImageManager::make($filepath)->encode('webp', 90)->save($filepath_webp);

        Plan::updateOrCreate(
            ['investment_id' => $model->id],
            ['file' => $name],
            ['file_webp' => $name_webp]
        );
    }
}
