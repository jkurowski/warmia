@extends('layouts.page', ['body_class' => 'investments'])

@section('meta_title', $floor->name)
@section('seo_title', $floor->meta_title)
@section('seo_description', $floor->meta_description)

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => $investment->name.' - '.$floor->name,
    'header_file' => 'rooms.jpg',
    'items' => [
        ['uri'=> '#plan', 'title' => 'Mieszkania']
        ]
    ])
@stop

@section('content')
    <div id="floor" class="container">
        <div class="row">
            <div class="col-12">
                @include('front.investment_shared.investment-filtr', ['area_range' => '25-45,45-65,65-85,85-110'])
            </div>
            <div id="sideMenu" class="col-2 mt-3 mt-lg-5">
                <div class="floor-nav">
                    @foreach($investments as $i)
                        <h3>{{$i->name}}</h3>
                        <ul class="list-unstyled">
                            @foreach($i->floors as $f)
                                <li @if($floor->id == $f->id) class="active" @endif ><a href="{{route('front.investment.floor', [$i->id, $f->id])}}">{{$f->name}}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-10 mt-0 mt-lg-5">
                <span onclick="toggleNav()" class="toggleSideMenu"><i class="las la-bars"></i> Zmień piętro</span>
                <div class="ps-0 ps-lg-5">
                    @if($floor->file)
                        <div id="plan-holder">
                            <img src="{{ asset('/investment/floor/webp/'.$floor->file_webp) }}" alt="{{$floor->name}}" id="invesmentplan" usemap="#invesmentplan">
                            <map name="invesmentplan">
                                @if($properties)
                                    @foreach($properties as $r)
                                        @if($r->html)
                                            <area shape="poly" data-item="{{$r->id}}" alt="{{$r->slug}}" data-roomnumber="{{$r->number}}" data-roomtype="{{$r->typ}}" data-roomstatus="{{$r->status}}" coords="{{cords($r->html)}}" class="inline status-{{$r->status}}" href="{{route('front.investment.property', ['investment_id' => $investment->id, 'floor' => $floor->id, 'property' => $r->id])}}" title="<h4>{{$r->name}}</h4>Powierzchnia: <b class=fr>{{$r->area}} m<sup>2</sup></b><br />Pokoje: <b class=fr>{{$r->rooms}}</b><br><b>{{ roomStatus($r->status) }}</b>">
                                        @endif
                                    @endforeach
                                @endif
                            </map>
                        </div>
                    @endif
                        @include('front.investment_shared.filtr', ['area_range' => $floor->area_range])

                        @include('front.investment_shared.list', ['investment' => $investment])
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('/js/plan/imagemapster.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/plan/tip.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/plan/floor.js') }}" charset="utf-8"></script>
        <script>
            function toggleNav() {
                const sideMenu = document.getElementById("sideMenu");
                const floor = document.getElementById("pagecontent");

                if(sideMenu.classList.contains('openMenu')){
                    sideMenu.style.width = "0";
                    sideMenu.classList.remove("openMenu");
                    floor.style.left = "0";
                    document.body.style.overflow = 'scroll';
                } else {
                    sideMenu.style.width = "250px";
                    sideMenu.classList.add("openMenu");
                    floor.style.left = "250px";
                    document.body.style.overflow = 'hidden';
                }
            }
        </script>
    @endpush
@endsection

