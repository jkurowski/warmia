<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS
use App\Models\Box;
use App\Models\Gallery;
use App\Models\Inline;
use App\Models\Page;
use App\Models\RodoRules;

class IndexController extends Controller
{
    public function index()
    {
        $boxes = Box::all()->sortBy('sort');
        $galleries = Gallery::withCount(['photos'])->where('status', '=', 1)->get();

        return view('front.homepage.index', [
            'boxes' => $boxes,
            'galleries' => $galleries,
            'array' => Inline::getElements(1),
            'contact' => Page::find(2),
            'rules' => RodoRules::orderBy('sort')->whereActive(1)->get()
        ]);
    }
}
