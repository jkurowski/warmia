<?php namespace App\Repositories;

use App\Models\Box;

class BoxRepository extends BaseRepository
{
    protected $model;

    public function __construct(Box $model)
    {
        parent::__construct($model);
    }
}
