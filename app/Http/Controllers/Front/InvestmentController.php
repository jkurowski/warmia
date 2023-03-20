<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Property;
use Illuminate\Http\Request;

// CMS
use App\Repositories\InvestmentRepository;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    private $repository;
    private $pageId;

    public function __construct(InvestmentRepository $repository)
    {
        $this->repository = $repository;
        $this->pageId = 2;
    }

    public function show(Request $request)
    {
        $investments = Investment::with('floors')->get();


        $query = Property::orderBy('status', 'ASC');

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

        $page = Page::where('id', $this->pageId)->first();

        return view('front.investment.show', [
            'investments' => $investments,
            'properties' => $query->get(),
            'page' => $page
        ]);
    }

    public function json(Request $request)
    {

        $investment = $this->repository->find(1);
        $investment_room = $investment->load(array(
            'floorRooms' => function ($query) use ($request) {
                $query->orderBy('status', 'ASC');
                if ($request->input('rooms')) {
                    $query->whereIn('rooms', explode(',', $request->input('rooms')));
                }
                if ($request->input('status')) {
                    $query->where('status', $request->input('status'));
                }
            }
        ));

        return $investment_room->floorRooms;
    }
}
