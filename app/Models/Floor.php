<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Floor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'building_id',
        'name',
        'number',
        'position',
        'type',
        'area_range',
        'price_range',
        'html',
        'cords',
        'file',
        'file_webp',
        'meta_title',
        'meta_description',
        'active'
    ];

    /**
     * Get floor properties
     * @return HasMany
     */
    public function properties(): HasMany
    {
        return $this->hasMany('App\Models\Property');
    }

    /**
     * Get floor properties
     * @return HasMany
     */
    public function propertiesForSale(): HasMany
    {
        return $this->hasMany('App\Models\Property')->where('status', '=', 1);
    }

    public function subFloors(): HasMany
    {
        return $this->hasMany('App\Models\Floor', 'parent_id', 'id')->orderBy('position');
    }

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($floor) {
            $floor->properties()->each(function($property) {
                $property->delete();
            });
        });
    }
}
