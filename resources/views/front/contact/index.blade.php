@extends('layouts.page', ['body_class' => 'contact no-top no-bottom'])

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
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="contact-text">
                        {!! $page->content !!}
                    </div>
                </div>
                <div class="col-6">
                    <form class="row validateForm" id="contact-form" action="" method="post">
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
                            <div class="form-floating">
                                <input name="form_name" id="form_name"
                                       class="validate[required] form-control @error('form_name') is-invalid @enderror"
                                       type="text" value="{{ old('form_name') }}" placeholder="">
                                <label for="form_name">Imię <span class="text-danger">*</span></label>
                                @error('form_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_email" id="form_email"
                                       class="validate[required,custom[email]] form-control @error('form_email') is-invalid @enderror"
                                       type="text" value="{{ old('form_email') }}" placeholder="">
                                <label for="form_email">E-mail <span class="text-danger">*</span></label>
                                @error('form_email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_phone" id="form_phone"
                                       class="validate[required,custom[phone]] form-control @error('form_phone') is-invalid @enderror"
                                       type="text" value="{{ old('form_phone') }}" placeholder="">
                                <label for="form_phone">Telefon <span class="text-danger">*</span></label>
                                @error('form_phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-floating">
                                <textarea rows="5" cols="1" name="form_message" id="form_message"
                                          class="validate[required] form-control @error('form_message') is-invalid @enderror"
                                          placeholder="">{{ old('form_message') }}</textarea>
                                <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
                                @error('form_message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($rules as $r)
                            <div class="col-12 mt-4">
                                <div class="rodo-rule clearfix">
                                    <input name="rule_{{$r->id}}" id="zgoda_{{$r->id}}" value="1" type="checkbox"
                                           @if($r->required === 1) class="validate[required]"
                                           @endif data-prompt-position="topLeft:0">
                                    <label for="zgoda_{{$r->id}}">{!! $r->text !!}</label>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 pt-5">
                            <script type="text/javascript">
                                document.write("<button class=\"bttn\" type=\"submit\">Wyślij wiadomość</button>");
                            </script>
                            <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b>
                                <p></noscript>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div id="map"></div>
    @push('scripts')
        <link rel="stylesheet" href="{{ URL::asset('css/leaflet.css') }}">
        <script type="text/javascript" src="{{ URL::asset('js/leaflet.js') }}"></script>
        <script>
            let map = L.map('map').setView([53.761629, 20.229406], 14),
                theMarker = {},
                zoom = map.getZoom(),
                latLng = map.getCenter();

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            const markerIcon = L.icon({
                iconUrl: '{{ asset('/images/map-investment-marker.png') }}',
                iconSize: [184, 118],
                iconAnchor: [92, 120],
            });
            L.marker([53.761629, 20.229406], {icon: markerIcon}).addTo(map).bindPopup("53.761639, 20.229417<br><a href='https://goo.gl/maps/Rwnqqyjd3Co29FQh9' target='_blank'>Znajdź dojazd</a>");
        </script>

    @endpush
@endsection