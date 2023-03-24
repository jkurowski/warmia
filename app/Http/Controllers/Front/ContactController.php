<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

use App\Mail\ChatSend;
use App\Models\RodoRules;
use App\Repositories\Client\ClientRepository;
use Illuminate\Support\Facades\Mail;

use App\Models\Property;
use App\Models\Recipient;

use App\Notifications\ContactNotification;
use App\Notifications\PropertyNotification;
use Cookie;


class ContactController extends Controller
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index ()
    {
        return view('front.contact.index', [
            'rules' => RodoRules::orderBy('sort')->whereActive(1)->get()
        ]);
    }

    function property(ContactFormRequest $request, $id)
    {

        $property = Property::find($id);
        $client = $this->repository->createClient($request, $property);
        $property->notify(new PropertyNotification($request));

        Mail::to(settings()->get("page_email"))->send(new ChatSend($request, $client, $property));

        if( count(Mail::failures()) == 0 ) {
            $cookie_name = 'dp_';
            foreach ($_COOKIE as $name => $value) {
                if (stripos($name, $cookie_name) === 0) {
                    Cookie::queue(
                        Cookie::forget($name)
                    );
                }
            }
        }

        return redirect()->back()->with(
            'success',
            'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!'
        );
    }

    function contact(ContactFormRequest $request, Recipient $recipient)
    {
        $recipient->notify(new ContactNotification($request));

        $client = $this->repository->createClient($request);
        Mail::to(settings()->get("page_email"))->send(new ChatSend($request, $client));

        if( count(Mail::failures()) == 0 ) {
            $cookie_name = 'dp_';
            foreach ($_COOKIE as $name => $value) {
                if (stripos($name, $cookie_name) === 0) {
                    Cookie::queue(
                        Cookie::forget($name)
                    );
                }
            }
        }

        return redirect()->back()->with(
            'success',
            'Twoja wiadomość została wysłana. W najbliższym czasie skontaktujemy się z Państwem celem omówienia szczegółów!'
        );
    }
}
