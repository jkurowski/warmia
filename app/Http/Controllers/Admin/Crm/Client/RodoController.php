<?php

namespace App\Http\Controllers\Admin\Crm\Client;

use App\Http\Controllers\Controller;

//CMS
use App\Models\Client;
use App\Models\ClientRules;

class RodoController extends Controller
{
    public function show(Client $client)
    {
        return view('admin.crm.client.rodo.index', [
            'client' => $client,
            'list' => ClientRules::where('client_id', $client->id)->latest()->get()
        ]);
    }
}
