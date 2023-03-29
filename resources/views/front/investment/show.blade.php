@extends('layouts.page', ['body_class' => 'investments no-top'])

@section('meta_title', 'Wybór domów')
@section('seo_title', 'Wybór domów')
@section('seo_description', 'Wybór domów')

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => 'Wybór domów',
    'header_file' => 'rooms.jpg',
    'items' => []
    ])
@stop

@section('content')
    @if($investment->plan)
        <div class="plan-info">Z planu poniżej, wybierz dom lub skorzystaj z <a href="">wyszukiwarki</a>.</div>
        <div id="plan">
            <div id="plan-holder"><img src="{{ asset('/investment/plan/'.$investment->plan->file.'') }}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
            <map name="invesmentplan">
                @if($investment->houses)
                    @foreach($investment->houses as $house)
                        <area
                                shape="poly"
                                href="{{route('property', $house)}}"
                                title="{{$house->name}}"
                                alt="{{$house->slug}}"
                                data-item="{{$house->id}}"
                                data-roomnumber="{{$house->number}}"
                                data-roomtype="{{$house->typ}}"
                                data-roomstatus="{{$house->status}}"
                                coords="@if($house->html) {{cords($house->html)}} @endif">
                    @endforeach
                @endif
            </map>
        </div>
    @endif

    <div id="floor" class="container">
        <div class="row">
            <div class="col-12 text-center pb-5">
                [ Tu pojawi się wyszukiwarka ]
            </div>
            <div class="col-12">
                <div class="ps-0 ps-lg-5">
                    @include('front.investment_shared.list')
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