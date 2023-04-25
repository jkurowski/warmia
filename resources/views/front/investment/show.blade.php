@extends('layouts.page', ['body_class' => 'investments no-top'])

@section('meta_title', $page->title)
@section('seo_title', $page->meta_title)
@section('seo_description', $page->meta_description)
@section('seo_robots', $page->meta_robots)

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => ($page->content_header) ?: $page->title,
    'header_file' => 'rooms.jpg',
    'items' => $page
    ])
@stop

@section('content')
    @if($investment->plan)
        @if($current_locale == 'pl')
        <div class="plan-info">Z planu poniżej, wybierz dom lub z listy <a href="#floor" class="scroll-to" data-offset="80">poniżej</a>.</div>
        @endif
        @if($current_locale == 'en')
        <div class="plan-info">Select a house from the plan below or from the list <a href="#floor" class="scroll-to" data-offset="80">below</a>.</div>
        @endif
        <div id="plan">
            <div id="plan-holder"><img src="{{ asset('/investment/plan/'.$investment->plan->file) }}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
            <map name="invesmentplan">
                @if($properties->count() > 0)
                    @foreach($properties as $house)
                        <area
                                shape="poly"
                                href="{{route('property', $house)}}"
                                title="{{$house->name}}<br>@lang('cms.property-area'): <b class=fr>{{$house->area}} m<sup>2</sup></b><br />@lang('cms.property-rooms'): <b class=fr>{{$house->rooms}}</b><br><b>{{ roomStatus($house->status) }}</b>"
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
    @if($properties->count() > 0)
    <div id="floor" class="container">
        <div class="row">
            <div class="col-12">
                <div class="ps-0 ps-lg-5">
                    @include('front.investment_shared.list')
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($properties->count() > 0)
        @push('scripts')
            <script src="{{ asset('/js/plan/imagemapster.js') }}" charset="utf-8"></script>
            <script src="{{ asset('/js/plan/tip.js') }}" charset="utf-8"></script>
            <script src="{{ asset('/js/plan/floor.js') }}" charset="utf-8"></script>
        @endpush
    @endif
@endsection