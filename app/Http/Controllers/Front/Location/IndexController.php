<?php

namespace App\Http\Controllers\Front\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//CMS
use App\Models\RodoRules;
use App\Models\Gallery;
use App\Models\Inline;
use App\Models\Page;
use App\Models\Box;

class IndexController extends Controller
{
    public function index()
    {
        $ids = [6,7];
        $boxes = Box::whereIn('id', $ids)->get()->sortBy('sort');
        $galleries = Gallery::withCount(['photos'])->where('status', '=', 2)->get();

        return view(('front.location.index'), [
            'boxes' => $boxes,
            'rules' => RodoRules::orderBy('sort')->whereActive(1)->get(),
            'page' => Page::find(4),
            'galleries' => $galleries,
            'array' => Inline::getElements(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
