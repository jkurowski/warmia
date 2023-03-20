<?php namespace App\Repositories;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentRepository extends BaseRepository
{
    protected $model;

    public function __construct(Investment $model)
    {
        parent::__construct($model);
    }

    public function getUniqueRooms(object $query)
    {
        return $query->sortBy('rooms')->unique('rooms')->pluck('rooms');
    }

    public function searchRooms(Investment $investment, Request $request)
    {

        $query = $investment->load(array(
            'searchProperties' => function ($query) use ($request) {
                if ($request->input('rooms')) {
                    $query->where('rooms', $request->input('rooms'));
                }
                if ($request->input('status')) {
                    $query->where('status', $request->input('status'));
                }
                if ($request->input('area_from')) {
                    $query->where('area', '>=', $request->input('area_from'));
                }
                if ($request->input('area_to')) {
                    $query->where('area', '<=', $request->input('area_to'));
                }
                if ($request->input('name')) {
                    $query->where('name', 'LIKE', '%'.$request->input('name').'%');
                }
            }
        ));

        return $query->searchProperties;
    }
}
