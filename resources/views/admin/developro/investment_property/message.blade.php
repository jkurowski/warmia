@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title"><i class="fe-inbox"></i>Wiadomości</h4>

                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link " href="{{route('admin.developro.edit', $investment->id)}}"><span class="fe-info"></span> {{$investment->name}}</a>

                    @if ($investment->type == 1)
                        <a class="nav-link {{ Request::routeIs('admin.developro.investment.building.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.building.index', $investment->id)}}"><span class="fe-package"></span> Lista budynków</a>
                    @endif

                    @if ($investment->type == 2)
                        <a class="nav-link {{ Request::routeIs('admin.developro.investment.floor.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.floor.index', $investment->id)}}"><span class="fe-layers"></span> Lista kondygnacji</a>
                    @endif

                    @if ($investment->type == 3)
                        <a class="nav-link {{ Request::routeIs('admin.developro.investment.house.index') ? ' active' : '' }}" href="{{route('admin.developro.investment.house.index', $investment->id)}}"><span class="fe-package"></span> Lista domów</a>
                    @endif

                    @if ($investment->type == 2)
                        <a class="nav-link" href="{{route('admin.developro.investment.floor.property.index', [$investment, $floor])}}"><span class="fe-square"></span>{{$floor->name}} -  Lista mieszkań</a>
                    @endif

                    @if ($investment->type == 1)
                        <a class="nav-link" href="{{route('admin.developro.investment.building.floor.property.index', [$investment, $building, $floor])}}"><span class="fe-square"></span>{{$floor->name}} -  Lista mieszkań</a>
                    @endif
                </nav>
            </div>

        </div>
        @foreach($property->roomsNotifications as $message)
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow inbox-message">
                    <div class="inbox-message-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-circle"><span class="initials">{{substr($message->data->form_name, 0, 1)}}</span></div>
                                <h4>{{ $message->data->form_name }}</h4>
                                <span>{{ $message->data->form_email }}</span>
                            </div>
                            <div class="col-6 d-flex align-items-end justify-content-end text-right">
                                <span>{{ $message->created_at }} @isset($message->data->ip) <br> IP: {{ $message->data->ip }} @endisset</span>
                            </div>
                            <div class="col-12">
                                <h2>{{ isset($message->data->form_subject) ? $message->data->form_subject : 'Brak tematu' }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="inbox-message-body">
                        <div class="row">
                            <div class="col-12">
                                {!! nl2br($message->data->form_message) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
