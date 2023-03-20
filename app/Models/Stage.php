<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Stage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board_stages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'board_id',
        'user_id',
        'name',
        'sort'
    ];

    /**
     * Get the tasks for the stage.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('sort')->whereUserId(auth()->id());
    }

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($stage) {
            $stage->tasks()->each(function($task) {
                $task->delete();
            });
        });

        static::creating(function ($event) {
            $event->user_id = Auth::id();
        });
    }
}
