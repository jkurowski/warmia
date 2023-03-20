<?php

namespace App\Http\Controllers\Front\Developro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// CMS
use App\Repositories\FloorRepository;
use App\Models\Floor;
use App\Models\Investment;
use App\Models\Page;

class InvestmentFloorController extends Controller
{
    private $repository;
    private $pageId;

    public function __construct(FloorRepository $repository)
    {
        $this->repository = $repository;
        $this->pageId = 2;
    }

    public function index($investment, $id, Request $request)
    {

        $floor = Floor::find($id);
        $investment = Investment::find($investment);

        $investments = Investment::with('floors')->get();

        $investment_room = $investment->load(array(
            'floorRooms' => function ($query) use ($floor, $request) {
                $query->where('floor_id', $floor->id);
                $query->orderBy('status', 'ASC');

                if ($request->input('rooms')) {
                    $query->where('rooms', $request->input('rooms'));
                }
                if ($request->input('status')) {
                    $query->where('status', $request->input('status'));
                }
                if ($request->input('area')) {
                    $area_param = explode('-', $request->input('area'));
                    $min = $area_param[0];
                    $max = $area_param[1];
                    $query->whereBetween('area', [$min, $max]);
                }
                if ($request->input('sort')) {
                    $order_param = explode(':', $request->input('sort'));
                    $column = $order_param[0];
                    $direction = $order_param[1];
                    $query->orderBy($column, $direction);
                }
            }
        ));

        $page = Page::where('id', $this->pageId)->first();

        return view('front.investment_floor.index', [
            'investments' => $investments,
            'investment' => $investment_room,
            'floor' => $floor,
            'properties' => $investment_room->floorRooms,
            'uniqueRooms' => $this->repository->getUniqueRooms($floor->properties()),
            'page' => $page
        ]);
    }
}
