@extends('layouts.page', ['body_class' => 'investments'])

@section('meta_title', 'Mieszkania')
@section('seo_title', 'Mieszkania')
@section('seo_description', 'Mieszkania')

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => 'Mieszkania',
    'header_file' => 'rooms.jpg',
    'items' => []
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
                                <li><a href="{{route('front.investment.floor', [$i->id, $f->id])}}">{{$f->name}}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-10 mt-0 mt-lg-5">
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