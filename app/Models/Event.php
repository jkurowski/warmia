<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{

    use LogsActivity;
    protected static $logName = 'Kalendarz';

    public $preventAttrSet = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'start',
        'end',
        'time',
        'note',
        'active',
        'allday',
        'type',
    ];

    protected $appends = ['allDay','title','color'];
    protected $hidden = ['allday','time'];

    /**
     * This will be called when fetching the element.
     */
    public function getAlldayAttribute()
    {
        return boolval($this->attributes['allday']);
    }

    /**
     * This will be called when fetching the element.
     */
    public function getStartAttribute()
    {
        if($this->attributes['allday'] == 1) {
            return $this->attributes['start'];
        } else {
            return $this->attributes['start'].'T'.$this->attributes['time'];
        }
    }

    /**
     * This will be called when fetching the element.
     */
    public function getTitleAttribute()
    {
            return $this->attributes['title'] = eventTitleIcon($this->attributes['type'], $this->attributes['name']);
    }

    /**
     * This will be called when fetching the element.
     */
    public function getColorAttribute()
    {
            if($this->attributes['active'] == 0) {
                return $this->attributes['color'] =  '#b01313';
            }
    }

    /**
     * This will be called when storing the element.
     */
    public function setAlldayAttribute($value)
    {
        if ($this->preventAttrSet) {
            $this->attributes['allday'] = $value;
        } else {
            if(!isset($this->attributes['time'])) {
                $this->attributes['allday'] = 1;
            } else {
                $this->attributes['allday'] = 0;
            }
        }
    }

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->user_id = Auth::id();
        });
    }
}
