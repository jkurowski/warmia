<?php

namespace App\Http\Controllers\Front\Developro;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Floor;
use App\Models\Page;
use App\Models\Property;
use App\Models\RodoRules;
use Illuminate\Validation\Rules\In;

class InvestmentPropertyController extends Controller
{
    private $pageId;

    public function __construct()
    {
        $this->pageId = 2;
    }

    public function index($lang, Property $property)
    {
        $investment = Investment::find(1);

        $page = Page::where('id', $this->pageId)->first();

        return view('front.investment_property.index', [
            'investment' => $investment,
            'property' => $property,
            'rules' => RodoRules::orderBy('sort')->whereActive(1)->get(),
            'next' => $property->findNext(0, $investment->id, $property->number_order),
            'prev' => $property->findPrev(0, $investment->id, $property->number_order),
            'page' => $page
        ]);
    }
}
