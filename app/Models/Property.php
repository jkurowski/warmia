<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Property extends Model
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'building_id',
        'floor_id',
        'status',
        'name',
        'name_list',
        'number',
        'number_order',
        'rooms',
        'area',
        'price',
        'garden_area',
        'balcony_area',
        'balcony_area_2',
        'terrace_area',
        'loggia_area',
        'parking_space',
        'garage',
        'type',
        'html',
        'cords',
        'file',
        'file_pdf',
        'file_webp',
        'en_file',
        'en_file_pdf',
        'en_file_webp',
        'meta_title',
        'meta_description',
        'content',
        'views',
        'active'
    ];

    /**
     * Get next property
     * @param int|null $floor_id
     * @param int $investment
     * @param int $number_order
     * @return Property
     */
    public static function findNext(?int $floor_id, int $investment, int $number_order)
    {
        $query = self::where('investment_id', $investment)
            ->orderBy('number_order', 'ASC')
            ->where('number_order', '>', $number_order)
            ->select(['number_order', 'id', 'investment_id', 'floor_id']);
        if ($floor_id) {
            $query->where('floor_id', $floor_id);
        }
        return $query->first();
    }

    /**
     * Get previous property
     * @param int|null $floor_id
     * @param int $investment
     * @param int $number_order
     * @return Property
     */
    public static function findPrev(?int $floor_id, int $investment, int $number_order)
    {
        $query = self::where('investment_id', $investment)
            ->orderBy('number_order', 'DESC')
            ->where('number_order', '<', $number_order)
            ->select(['number_order', 'id', 'investment_id', 'floor_id']);
        if ($floor_id) {
            $query->where('floor_id', $floor_id);
        }
        return $query->first();
    }

    /**
     * Get notifications for room
     * @return HasMany
     */
    public function roomsNotifications(): HasMany
    {
        return $this->hasMany(
            'App\Models\Notification',
            'notifiable_id',
            'id'
        )->where('notifiable_type', 'App\Models\Property')->latest();
    }

//    public static function boot()
//    {
//        parent::boot();
//        self::deleting(function ($property) {
//
//        });
//    }
}
