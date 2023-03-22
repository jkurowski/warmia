<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Gallery;
use App\Models\Image;

// CMS

class IndexController extends Controller
{
    public function index()
    {
        $boxes = Box::all()->sortBy('sort');
        $galeries = Gallery::all()->where('status', '=', 1);

        $images = Image::all()->whereIn('gallery_id', $galeries->pluck('id'));

        return view('front.homepage.index', ['boxes' => $boxes, 'galeries' => $galeries, 'images' => $images]);
    }
}
