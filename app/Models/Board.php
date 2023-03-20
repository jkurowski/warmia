<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name'
    ];

    /**
     * Get the stages for the board.
     */
    public function stages()
    {
        return $this->hasMany(Stage::class)->orderBy('sort')->whereUserId(auth()->id());
    }
}
