<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RodoRules extends Model
{
    use HasTranslations;
    public array $translatable = ['text'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'required',
        'time',
        'active',
        'sort'
    ];
}
