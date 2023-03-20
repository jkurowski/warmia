<?php

namespace App\Http\Controllers\Admin\Crm\Client;

use App\Http\Controllers\Controller;
use App\Mail\ChatSend;
use App\Models\ClientMessage;
use Illuminate\Http\Request;

//CMS
use App\Repositories\Chat\ChatRepository;
use App\Http\Requests\ChatFormRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    private $repository;

    public function __construct(ChatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(Client $client)
    {
        return view('admin.crm.client.chat.index', [
            'client' => $client,
            'chat' => ClientMessage::where('client_id', '=', $client->id)->where('user_id', '=', 0)->with(['answers', 'investments'])->latest()->get()
        ]);
    }

    public function form(Request $request, Client $client)
    {
        if (request()->ajax()) {
            return view('admin.crm.modal.chat-form', ['client' => $client, 'id' => $request->input('id')])->render();
        }
    }

    public function mark(Request $request, Client $client)
    {
        if (request()->ajax()) {
            return $this->repository->markMessage($request, $client);
        }
    }

    public function create(ChatFormRequest $request, Client $client)
    {
        Mail::to($client->mail)->send(new ChatSend($request, $client));
        if( count(Mail::failures()) > 0 ) {
            return ['success' => false];
        } else {
            $this->repository->storeAnswer($request, $client);
            return ['success' => true];
        }
    }
}
