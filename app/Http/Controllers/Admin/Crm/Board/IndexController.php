<?php

namespace App\Http\Controllers\Admin\Crm\Board;

use App\Http\Controllers\Controller;
use App\Models\Board;

//CMS

class IndexController extends Controller
{
    public function index()
    {
        $board = Board::with('stages.tasks.client')->get();
        return view('admin.crm.board.index', ['board' => $board]);
    }
}
