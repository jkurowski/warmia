<?php

namespace App\Http\Controllers\Admin\Crm\Inbox;

use App\Http\Controllers\Controller;

// CMS
use App\Models\ClientMessage;
use Yajra\DataTables\DataTables;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.crm.inbox.index');
    }

    public function datatable()
    {
        $list = ClientMessage::orderBy('created_at', 'desc')
            ->whereUserId(0)
            ->with('client', 'utms')
            ->get();

        return Datatables::of($list)
            ->editColumn('name', function ($row){
                return '<a href="'.route('admin.crm.clients.chat.show', $row->client).'">'.$row->client->name.'</a>';
            })
            ->editColumn('mail', function ($row){
                return $row->client->mail;
            })
            ->editColumn('referrer', function ($row){
                return getFromUtm($row->utms, 'source');
            })
            ->editColumn('campaign', function ($row){
                return getFromUtm($row->utms, 'campaign');
            })
            ->editColumn('click', function ($row){
                return getFromUtm($row->utms, 'fbclid').getFromUtm($row->utms, 'gclid');
            })
            ->editColumn('created_at', function ($row){
                return $row->created_at->diffForHumans().'<span>'.$row->created_at->format('Y-m-d H:i:s').'</span>';
            })
            ->rawColumns(['name', 'created_at'])
            ->make(true);
    }
}
