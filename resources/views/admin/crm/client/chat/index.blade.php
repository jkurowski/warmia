@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-mail"></i><a href="{{route('admin.crm.clients.index')}}">Klienci</a><span class="d-inline-flex me-2 ms-2">/</span><a href="{{ route('admin.crm.clients.show', $client->id) }}">{{$client->name}}</a><span class="d-inline-flex me-2 ms-2">/</span>Wiadomości</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit"></div>
            </div>
        </div>
        @include('admin.crm.client.client_shared.menu')
        <div class="row">
            <div class="col-4">
                @include('admin.crm.client.client_shared.aside')
            </div>
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-body card-body-rem">
                        <div id="chat">
                            @foreach($chat as $msg)
                            <div class="chat-box d-flex align-items-end float-end mb-4 flex-row-reverse @if($msg->mark_at) chat-mark @endif" data-msg-id="{{$msg->id}}">
                                <div class="chat-avatar">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle">{!! mb_substr($client->name, 0, 1) !!}</span>
                                    </div>
                                </div>
                                <div class="chat-text d-flex flex-wrap">
                                    <div class="chat-text-content w-100">
                                        {{ $msg->message ?: 'Proszę o kontakt' }}
                                        @if($msg->investment)
                                        <div class="chat-text-desc">{{ $msg->investments->name }} <span class="separator">·</span>
                                            {{ $msg->property }} / Pokoje: {{ $msg->rooms }} / {{ $msg->area }} m<sup>2</sup></div>
                                        @endif
                                    </div>
                                    <div class="chat-text-date w-50 pt-1 ps-2" title="{{ $msg->created_at }}">{{$msg->created_at->diffForHumans()}}</div>
                                    <div class="chat-text-action w-50 pt-1 pe-2">
                                        <a role="button" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-menu-dots"><i class="fe-more-horizontal-"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item dropdown-item-replay" href="#">Odpowiedz</a></li>
                                            <li><a class="dropdown-item dropdown-item-mark" href="#">Oznacz jako ważna</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                @foreach($msg->answers as $answer)
                                    <div class="chat-box d-flex align-items-end float-start mb-4">
                                        <div class="chat-avatar">
                                            <div class="avatar">
                                                <span class="avatar-title rounded-circle">{{ $answer->user_id }}</span>
                                            </div>
                                        </div>
                                        <div class="chat-text">
                                            <div class="chat-text-content">
                                                {!! $answer->message !!}
                                            </div>
                                            <div class="chat-text-date pt-1 ps-2" title="{{ $answer->created_at }}">{{$answer->created_at->diffForHumans()}}</div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                @endforeach
                            @endforeach
                            <div class="chat-box d-flex align-items-end float-start mb-4 d-none">
                                <div class="chat-avatar">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle">JK</span>
                                    </div>
                                </div>
                                <div class="chat-text">
                                    <div class="chat-text-content">
                                        <h4>Oferta nr. 4</h4>
                                        <p>W nawiązaniu do spotkania przesyłam rzut wybranych mieszkań. W razie decyzji, proszę o telefon.</p>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-4">
                                                <div class="offer">
                                                    <img src="https://www.kalternieruchomosci.pl/files/inwestycje/pomieszczenie/lista/20220115013046-mieszkanie-d110.jpg" alt="" class="mb-2">
                                                    <p><b>Mieszkanie D/110</b></p>
                                                    <p>Pokoje: 4</p>
                                                    <p>Pow.: 81.37 m<sup>2</sup></p>
                                                    <p>Piętro: 2</p>
                                                    <a href="">Link do mieszkania</a>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="offer">
                                                    <img src="https://www.kalternieruchomosci.pl/files/inwestycje/pomieszczenie/lista/20220115124524-mieszkanie-a17.jpg" alt="" class="mb-2">
                                                    <p><b>Mieszkanie A/17</b></p>
                                                    <p>Pokoje: 3</p>
                                                    <p>Pow.: 47.68 m<sup>2</sup></p>
                                                    <p>Piętro: 3</p>
                                                    <a href="">Link do mieszkania</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-text-date">29-08-2022 11:46:34</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="chat-box d-flex align-items-end float-start mb-4 d-none">
                                <div class="chat-avatar">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle">JK</span>
                                    </div>
                                </div>
                                <div class="chat-text">
                                    <div class="chat-text-content">
                                        <p>Bardzo proszę :) Przesyłam jako załącznik umowę do podpisania oraz regulamin. Pozdrawiam</p>
                                        <div class="file"><i class="fe-file-text"></i> <a href="">Umowa kupna-sprzedazy.pdf</a></div>
                                        <div class="file"><i class="fe-file-text"></i> <a href="">Regulamin.pdf</a></div>
                                    </div>
                                    <div class="chat-text-date">30-08-2022 09:02:55</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @routes('chat')
    @push('scripts')
        <script>
            const chat = $("#chat");

            chat.on('click', '.dropdown-item-replay', function(event){
                const target = event.target;
                const parent = target.closest(".chat-box");
                jQuery.ajax({
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': parent.dataset.msgId
                    },
                    url: route('admin.crm.clients.chat.form', {{$client->id}}),
                    success: function(response) {
                        if(response) {
                            document.querySelectorAll('.modal,.tox,.modal-script').forEach(el => el.remove());
                            $('body').append(response);
                        } else {
                            alert('Error');
                        }
                    }
                });
            });

            chat.on('click', '.dropdown-item-mark', function(event){
                const target = event.target;
                const parent = target.closest(".chat-box");
                jQuery.ajax({
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': parent.dataset.msgId
                    },
                    url: route('admin.crm.clients.chat.mark', {{$client->id}}),
                    success: function(response) {
                        const mark = parent.classList.contains('chat-mark');
                        if(mark){
                            parent.classList.remove('chat-mark');
                        } else {
                            parent.classList.add('chat-mark');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
