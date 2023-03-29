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
        /**
         * Inwestycja z domami
         */
        $investment = Investment::find(1);
        if ($investment->type == 3) {
            $investment_room = $investment->load(array(
                'properties' => function ($query) use ($request) {
                    if ($request->input('rooms')) {
                        $query->where('rooms', $request->input('rooms'));
                    }
                    if ($request->input('status')) {
                        $query->where('status', $request->input('status'));
                    }
                    if ($request->input('sort')) {
                        $order_param = explode(':', $request->input('sort'));
                        $column = $order_param[0];
                        $direction = $order_param[1];
                        $query->orderBy($column, $direction);
                    }
                }
            ));

            $properties = $investment_room->properties;
        }

        return view('front.investment.show', [
            'investment' => $investment,
            'properties' => $properties,
            'uniqueRooms' => $this->repository->getUniqueRooms($investment_room->properties),
            'page' => Page::whereId($this->pageId)->first()
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
