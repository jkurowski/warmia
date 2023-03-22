<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Box extends Model
{

    use HasTranslations;
    public $translatable = ['title', 'text', 'file_alt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id',
        'title',
        'text',
        'file',
        'file_alt',
        'file_webp',
        'sort'
    ];
}
