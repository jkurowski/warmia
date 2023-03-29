@extends('layouts.page', ['body_class' => 'property'])

@section('meta_title', $property->name)
@section('seo_title', $property->name)

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => $property->name,
    'header_file' => 'rooms.jpg',
    'items' => [
        ['uri'=> '#plan', 'title' => 'Mieszkania'],
        ['uri'=> '']
    ]
])
@stop

@section('content')
<div id="property">
    <div class="container-fluid container-md">
        <div id="propertyNav" class="row">
            <div class="col-12 col-sm-4">
                @if($prev) <a href="" class="bttn bttn-nav">Poprzednie</a>@endif
            </div>
            <div class="col-12 col-sm-4">
                <a href="{{route('plan')}}" class="bttn bttn-nav">Plan inwestycji</a>
            </div>
            <div class="col-12 col-sm-4">
                @if($next) <a href="" class="bttn bttn-nav">Następne</a>@endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-5 pe-3 pe-xl-5">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-12 order-2 order-lg-1">
                        <div class="property-img">
                            @if($property->file)
                                <a href="{{ asset('/investment/property/'.$property->file) }}" class="swipebox">
                                    <picture>
                                        <source type="image/webp" srcset="{{ asset('/investment/property/thumbs/webp/'.$property->file_webp) }}">
                                        <source type="image/jpeg" srcset="{{ asset('/investment/property/thumbs/'.$property->file) }}">
                                        <img src="{{ asset('/investment/property/thumbs/'.$property->file) }}" alt="{{$property->name}}">
                                    </picture>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-12 order-1 order-lg-2">
                        <div class="property-desc">
                            <div class="room-status room-status-{{$property->status}}">
                                {{ roomStatus($property->status )}}
                            </div>
                            @if($property->price)
                                <h6 class="propertyPrice">@money($property->price)</h6>
                            @endif
                            <ul class="list-unstyled">
                                <li>Pokoje:<span>{{$property->rooms}}</span></li>
                                <li>Powierzchnia:<span>{{$property->area}} m<sup>2</sup></span></li>
                                @if($property->garden_area)<li>Ogródek:<span>{{$property->garden_area}} m<sup>2</sup></span></li>@endif
                                @if($property->balcony_area)<li>Balkon:<span>{{$property->balcony_area}} m<sup>2</sup></span></li>@endif
                                @if($property->balcony_area_2)<li>Balkon 2:<span>{{$property->balcony_area_2}} m<sup>2</sup></span></li>@endif
                                @if($property->terrace_area)<li>Taras:<span>{{$property->terrace_area}} m<sup>2</sup></span></li>@endif
                                @if($property->loggia_area)<li>Balkon 3:<span>{{$property->loggia_area}} m<sup>2</sup></span></li>@endif
                                @if($property->parking_space)<li>Miejsce postojowe:<span>{{$property->parking_space}}</span></li>@endif
                                @if($property->garage)<li>Garaż:<span>{{$property->garage}}</span></li>@endif
                            </ul>

                            <div class="d-flex justify-content-center">
                                @if($property->file_pdf)
                                    <a href="{{ asset('/investment/property/pdf/'.$property->file_pdf) }}" target="_blank" class="bttn">POBIERZ PLAN .PDF</a>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center d-block d-lg-none">
                                <a href="#contact" class="bttn scroll-to" data-offset="0">FORMULARZ KONTAKTOWY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-7">
                <div id="contact">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-12">
                                Dane firmowe
                            </div>
                        </div>
                        <form class="row validateForm" id="contact-form" action="{{route('contact.property', $property->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="col-12">
                                @if (session('success'))
                                    <div class="alert alert-success border-0">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('warning'))
                                    <div class="alert alert-warning border-0">
                                        {{ session('warning') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="form_name">Imię <span class="text-danger">*</span></label>
                                <input name="form_name" id="form_name" class="validate[required] form-control @error('form_name') is-invalid @enderror" type="text" value="{{ old('form_name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                            </div>
                            <div class="col-12 col-sm-6 mt-4">
                                <label for="form_email">E-mail <span class="text-danger">*</span></label>
                                <input name="form_email" id="form_email" class="validate[required] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-4">
                                <label for="form_phone">Telefon <span class="text-danger">*</span></label>
                                <input name="form_phone" id="form_phone" class="validate[required] form-control @error('form_phone') is-invalid @enderror" type="text" value="{{ old('form_phone') }}">

                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
                                <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror">{{ old('form_message') }}</textarea>

                                @error('message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            @foreach ($rules as $r)
                                <div class="col-12 mt-4">
                                    <div class="rodo-rule clearfix">
                                        <input name="rule_{{$r->id}}" id="zgoda_{{$r->id}}" value="1" type="checkbox" @if($r->required === 1) class="validate[required]" @endif data-prompt-position="topLeft:0">
                                        <label for="zgoda_{{$r->id}}">{!! $r->text !!}</label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-12">
                                <input name="form_page" type="hidden" value="{{$property->name}}">
                                <script type="text/javascript">
                                    document.write("<button class=\"bttn\" type=\"submit\">WYŚLIJ WIADOMOŚĆ</button>");
                                </script>
                                <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ asset('/js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('/js/pl.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validateForm").validationEngine({
                validateNonVisibleFields: true,
                updatePromptsPosition:true,
                promptPosition : "topRight:-137px"
            });
        });
        @if (session('success')||session('warning'))
        $(window).load(function() {
            const aboveHeight = $('header').outerHeight();
            $('html, body').stop().animate({
                scrollTop: $('.alert').offset().top-aboveHeight
            }, 1500, 'easeInOutExpo');
        });
        @endif
    </script>
@endpush
