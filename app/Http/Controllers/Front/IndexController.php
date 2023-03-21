<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Box;

// CMS

class IndexController extends Controller
{
    public function index()
    {
        $boxes = Box::all()->sortBy('sort');

        return view('front.homepage.index', ['boxes' => $boxes]);
    }
}
