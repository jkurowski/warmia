<?php

namespace App\Observers;

use App\Models\Property;
use Illuminate\Support\Facades\File;

class PropertyObserver
{
    /**
     * Handle the Property "deleted" event.
     *
     * @param Property $property
     * @return void
     */
    public function deleted(Property $property)
    {
        if (File::isFile(public_path('investment/property/' . $property->file))) {
            File::delete(public_path('investment/property/' . $property->file));
        }
        if (File::isFile(public_path('investment/property/thumbs/' . $property->file))) {
            File::delete(public_path('investment/property/thumbs/' . $property->file));
        }
        if (File::isFile(public_path('investment/property/list/' . $property->file))) {
            File::delete(public_path('investment/property/list/' . $property->file));
        }
        if (File::isFile(public_path('investment/property/webp/' . $property->file_webp))) {
            File::delete(public_path('investment/property/webp/' . $property->file_webp));
        }
        if (File::isFile(public_path('investment/property/thumbs/webp/' . $property->file_webp))) {
            File::delete(public_path('investment/property/thumbs/webp/' . $property->file_webp));
        }
        if (File::isFile(public_path('investment/property/list/webp/' . $property->file_webp))) {
            File::delete(public_path('investment/property/list/webp/' . $property->file_webp));
        }
        if (File::isFile(public_path('investment/property/pdf/' . $property->file_pdf))) {
            File::delete(public_path('investment/property/pdf/' . $property->file_pdf));
        }
    }
}
