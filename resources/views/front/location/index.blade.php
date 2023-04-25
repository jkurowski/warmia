@extends('layouts.page', ['body_class' => 'location no-top no-bottom'])

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
    <section id="investment">
        <div class="container inline inline-tc">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-start">
                        <p data-modaleditor="9">{{ getInline($array, 9, 'modaleditor') }}</p>
                        <h2 data-modaltytul="9">{!! getInline($array, 9, 'modaltytul') !!}</h2>
                    </div>
                </div>
            </div>
            <div class="row row-with-icons">
                <div class="col-12 col-xl-6 order-2 order-xl-1">
                    <div class="row">
                        @foreach($boxes as $box)
                            @if($box->place_id == 6)
                                <div class="col-12 col-md-4 col-xl-12">
                                    <div class="box-icon">
                                        <div class="box-icon-img">
                                            <img src="{{ asset('/uploads/box/'.$box->file) }}" alt="{{ $box->file_alt }}">
                                        </div>
                                        <div class="box-icon-text">
                                            <h3>{{ $box->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-xl-6 d-flex align-items-center order-1 order-xl-2">
                    <div data-modaleditortext="9">
                        {!! getInline($array, 9, 'modaleditortext') !!}
                    </div>
                </div>
            </div>
            @auth
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="9" data-hideinput="modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            @endauth
        </div>
    </section>

    <picture>
        <source srcset="{{ asset('/images/location-lake.webp') }}" type="image/webp">
        <source srcset="{{ asset('/images/location-lake.jpg') }}" type="image/jpeg">
        <img src="{{ asset('/images/location-lake.jpg') }}" alt="Zdjęcie okolicy, jezioro, zielona łąka." loading="lazy" width="1920" height="830" class="w-100">
    </picture>

    <section id="features">
        <div class="container">
            <div class="row inline inline-tc">
                <div class="col-12">
                    <div class="section-title text-center">
                        <p data-modaleditor="10">{{ getInline($array, 10, 'modaleditor') }}</p>
                        <h2 data-modaltytul="10">{!! getInline($array, 10, 'modaltytul') !!}</h2>
                    </div>
                </div>
                @auth
                    <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="10" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                @endauth
            </div>
            <div class="row">
                @foreach($boxes as $box)
                    @if($box->place_id == 7)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="box-icon">
                                <div class="box-icon-img">
                                    <img src="{{ asset('/uploads/box/'.$box->file) }}" alt="{{ $box->file_alt }}">
                                </div>
                                <div class="box-icon-text">
                                    <h3>{{ $box->title }}</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section id="bike">
        <div class="apla inline inline-tc">
            <h2 data-modaltytul="11">{!! getInline($array, 11, 'modaltytul') !!}</h2>
            <p data-modaleditor="11">{{ getInline($array, 11, 'modaleditor') }}</p>
            @auth
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="11" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            @endauth
        </div>
    </section>

    <div class="map-holder">
        <div id="map"></div>
    </div>

    <section id="gallery">
        <div class="container">
            <div class="row inline inline-tc">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 data-modaltytul="12">{!! getInline($array, 12, 'modaltytul') !!}</h2>
                    </div>
                </div>
                @auth
                    <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="12" data-hideinput="modallink,modallinkbutton,modaleditortext,modaleditor,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                @endauth
            </div>
        </div>

        <ul id="gallery-carousel" class="mb list-unstyled">
            @foreach($galleries as $gallery)
                @foreach($gallery->photos as $img)
                    <li class="gallery-{{$img->gallery_id}}">
                        <a href="{{ asset('/uploads/gallery/images/'.$img->file) }}" class="swipebox" data-fslightbox="gallery" title="{{ $img->file_alt }}">
                        <picture>
                            <source srcset="{{ asset('/uploads/gallery/images/thumbs/webp/'.$img->file_webp) }}" type="image/webp">
                            <source srcset="{{ asset('/uploads/gallery/images/thumbs/'.$img->file) }}" type="image/jpeg">
                            <img src="{{ asset('/uploads/gallery/images/thumbs/'.$img->file) }}" alt="{{ $img->file_alt }}" loading="lazy" width="1360" height="765">
                        </picture>
                        @if($img->file_alt)
                        <div class="gallery-apla">
                            {{ $img->file_alt }}
                        </div>
                        @endif
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </section>

    <section id="contact" class="blue-bg">
        <div class="container">
            <div class="row">
                <div class="mb-4 mb-lg-0 col-12 col-lg-6">
                    <div class="contact-text">
                        {!! $contact->content !!}
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <form class="row validateForm" id="contact-form" action="{{route('homepage.contact')}}" method="post">
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
                                <input name="form_name" id="form_name" class="validate[required] form-control @error('form_name') is-invalid @enderror" type="text" value="{{ old('form_name') }}" placeholder="">
                                <label for="form_name">@lang('cms.form-name') <span class="text-danger">*</span></label>
                                @error('form_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_email" id="form_email" class="validate[required,custom[email]] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}" placeholder="">
                                <label for="form_email">@lang('cms.form-email') <span class="text-danger">*</span></label>
                                @error('form_email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_phone" id="form_phone" class="validate[required,custom[phone]] form-control @error('form_phone') is-invalid @enderror" type="text" value="{{ old('form_phone') }}" placeholder="">
                                <label for="form_phone">@lang('cms.form-phone') <span class="text-danger">*</span></label>
                                @error('form_phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-4 mb-2">
                            <div class="form-floating">
                                <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror" placeholder="">{{ old('form_message') }}</textarea>
                                <label for="form_message">@lang('cms.form-message') <span class="text-danger">*</span></label>
                                @error('form_message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($rules as $r)
                            <div class="col-12 mt-2">
                                <div class="rodo-rule clearfix">
                                    <input name="rule_{{$r->id}}" id="zgoda_{{$r->id}}" value="1" type="checkbox" @if($r->required === 1) class="validate[required]" @endif data-prompt-position="topLeft:0">
                                    <label for="zgoda_{{$r->id}}">{!! $r->text !!}</label>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 pt-5">
                            <script type="text/javascript">
                                document.write("<button class=\"bttn\" type=\"submit\">@lang('cms.form-button')</button>");
                            </script>
                            <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <link rel="stylesheet" href="{{ asset('/css/leaflet.css') }}">
        <script src="{{ asset('/js/leaflet.js') }}"></script>
        <script src="{{ asset('/js/validation.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/'.$current_locale.'.js') }}" charset="utf-8"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".validateForm").validationEngine({
                    validateNonVisibleFields: true,
                    updatePromptsPosition:true,
                    promptPosition : "topRight:-137px"
                });

                $('.rodo-rule p').readmore({
                    speed: 75,
                    collapsedHeight: 50,
                    moreLink: '<a href="#">@lang('cms.rodo-rules-more')</a>',
                    lessLink: '<a href="#">@lang('cms.rodo-rules-collapse')</a>',
                    heightMargin: 6
                });

                $("#gallery-carousel").slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
            });
            let map = L.map('map').setView([50.29234233715241, 18.66161871182686], 13),
                theMarker = {},
                zoom = map.getZoom(),
                latLng = map.getCenter();

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            const icon_1 = new L.icon({iconUrl: '{{ asset('/images/markers/inwestycja-icon.png') }}', iconSize: [48, 48], iconAnchor: [24, 24], popupAnchor: [0, -24]});
            const icon_2 = new L.icon({iconUrl: '{{ asset('/images/markers/stadion-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_3 = new L.icon({iconUrl: '{{ asset('/images/markers/piekarnia-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_4 = new L.icon({iconUrl: '{{ asset('/images/markers/apteka-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_5 = new L.icon({iconUrl: '{{ asset('/images/markers/sklep-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_6 = new L.icon({iconUrl: '{{ asset('/images/markers/paliwo-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_7 = new L.icon({iconUrl: '{{ asset('/images/markers/restauracja-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_8 = new L.icon({iconUrl: '{{ asset('/images/markers/przedszkole-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_9 = new L.icon({iconUrl: '{{ asset('/images/markers/szkola-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});
            const icon_10 = new L.icon({iconUrl: '{{ asset('/images/markers/kosciol-icon.png') }}', iconSize: [34, 34], iconAnchor: [17, 17], popupAnchor: [0, -17]});

            let markers = [
                @foreach ($list as $p)
                    [{{$p->lat}}, {{$p->lng}}, '{{$p->name}}', icon_{{$p->group_id}}],
                @endforeach
                ],
                route = L.featureGroup().addTo(map),
                n = markers.length;
            for (let i = 0; i < n-1; i++) {
                let marker = new L.Marker([markers[i][0], markers[i][1]], {icon: markers[i][3]}).bindPopup(markers[i][2]);
                route.addLayer(marker);
            }
            route.addLayer(new L.Marker([markers[n-1][0], markers[n-1][1]], {icon: markers[n-1][3]}).bindPopup(markers[n-1][2]));
            map.fitBounds(route.getBounds(), {
                padding: [20, 20]
            });
            function debounce(func) {
                let timer;
                return function (event) {
                    if (timer) clearTimeout(timer);
                    timer = setTimeout(func, 100, event);
                };
            }

            window.addEventListener("resize", debounce(function () {
                map.fitBounds(route.getBounds(), {
                    padding: [20, 20]
                });
            }));
            @if (session('success')||session('warning'))
            $(document).ready(function() {
                const aboveHeight = $('header').outerHeight();
                $('html, body').animate({
                    scrollTop: $('.alert').offset().top - aboveHeight
                }, 1500, 'easeInOutExpo');
            });
            @endif
        </script>
    @endpush
@endsection