@extends('layouts.homepage')

@section('content')
    <div class="d-block">
        <section id="slider">

        <ul class="mb-0 list-unstyled">
            <li>
                <img src="{{ asset('/uploads/slider/slider-1.jpg') }}" alt="" class="w-100">
                <div class="slider-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Miejsce, gdzie natura <br>spotyka się z luksusem</h1>
                            <a href="" class="bttn mt-5 mb-5">Znajdź swój dom</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <img src="{{ asset('/uploads/slider/slider-2.jpg') }}" alt="" class="w-100">
                <div class="slider-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Żyj aktywnie na Warmii</h1>
                            <a href="{{ route('location') }}" class="bttn mt-5 mb-5">Lokalizacja</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        </section>

        <section id="investment" class="pb-0">
            <div class="container inline inline-tc">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-start">
                            <p data-modaleditor="6">{{ getInline($array, 6, 'modaleditor') }}</p>
                            <h2 data-modaltytul="6">{!! getInline($array, 6, 'modaltytul') !!}</h2>
                        </div>
                    </div>
                </div>
                <div class="row row-with-icons">
                    <div class="col-6">
                        <div class="row">
                            @foreach($boxes as $box)
                                @if($box->place_id == 1)
                                    <div class="col-12">
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
                    <div class="col-6 d-flex align-items-center">
                        <div data-modaleditortext="6">
                            {!! getInline($array, 6, 'modaleditortext') !!}
                        </div>
                    </div>
                </div>
                @auth
                    <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="6" data-hideinput="modallink,modallinkbutton,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                @endauth
            </div>
        </section>

        <section id="plan" class="pb-0">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 data-modaltytul="5">{{ getInline($array, 5, 'modaltytul') }}</h2>
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="5" data-hideinput="modallink,modallinkbutton,modaleditor,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
            </div>
            <img src="{{ asset('/images/plan.jpg') }}" alt="Plan inwestycji">
        </section>

        <section id="features">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <p data-modaleditor="4">{{ getInline($array, 4, 'modaleditor') }}</p>
                            <h2 data-modaltytul="4">{{ getInline($array, 4, 'modaltytul') }}</h2>
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="4" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
                <div class="row">
                    @foreach($boxes as $box)
                        @if($box->place_id == 2)
                            <div class="col-3">
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

        <section id="restzone">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-6">
                        <h2 data-modaltytul="7">{!! getInline($array, 7, 'modaltytul') !!}</h2>
                    </div>
                    <div class="col-6">
                        <div data-modaleditortext="7">
                            {!! getInline($array, 7, 'modaleditortext') !!}
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="7" data-hideinput="modallink,modallinkbutton,modaleditor,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
                <div class="row">

                    @foreach($boxes as $box)
                        @if($box->place_id == 3)
                            <div class="col-3">
                                <div class="blue-box">
                                    <div class="blue-box-img">
                                        <img src="{{ asset('/uploads/box/'.$box->file) }}" alt="{{ $box->file_alt }}">
                                    </div>
                                    <div class="blue-box-title">
                                        <h3>{{ $box->title }}</h3>
                                    </div>
                                    <div class="blue-box-text">
                                        <p>{{ $box->text }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section id="lake">
            <div class="apla inline inline-tc">
                <h2 data-modaltytul="8">{!! getInline($array, 8, 'modaltytul') !!}</h2>
                <p data-modaleditor="8">{{ getInline($array, 8, 'modaleditor') }}</p>
                @auth
                    <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="8" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                @endauth
            </div>
        </section>

        <picture>
            <source srcset="{{ asset('/images/mapa.webp') }}" type="image/webp">
            <source srcset="{{ asset('/images/mapa.jpg') }}" type="image/jpeg">
            <img src="{{ asset('/images/mapa.jpg') }}" alt="Mapa okolicy i lokalizacja inwestycji" loading="lazy" width="1920" height="1123" class="w-100">
        </picture>

        <section id="gallery" class="pb-0">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <p data-modaleditor="3">{{ getInline($array, 3, 'modaleditor') }}</p>
                            <h2 data-modaltytul="3">{{ getInline($array, 3, 'modaltytul') }}</h2>
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="3" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        <div id="gallery-nav">
                            <ul class="list-unstyled mb-0 row filter">
                                <li class="col-3">
                                    <span class="bttn bttn-border bttn-active" data-filter="all">@lang('cms.filter-all') @endlang</span>
                                </li>
                                @foreach($galleries as $gallery)
                                    @if($gallery->photos_count > 0)
                                        <li class="col-3">
                                            <span class="bttn bttn-border" data-filter="gallery-{{ $gallery->id }}">{{ $gallery->name }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <ul id="gallery-carousel" class="mb list-unstyled">
                @foreach($galleries as $gallery)
                    @foreach($gallery->photos as $img)
                        <li class="gallery-{{$img->gallery_id}}">
                            <picture>
                                <source srcset="{{ asset('/uploads/gallery/images/webp/'.$img->file_webp) }}" type="image/webp">
                                <source srcset="{{ asset('/uploads/gallery/images/'.$img->file) }}" type="image/jpeg">
                                <img src="{{ asset('/uploads/gallery/images/'.$img->file) }}" alt="Obrazek galerii" loading="lazy" width="1360" height="765">
                            </picture>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </section>

        <section id="standards">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <p data-modaleditor="1">{{ getInline($array, 1, 'modaleditor') }}</p>
                            <h2 data-modaltytul="1">{{ getInline($array, 1, 'modaltytul') }}</h2>
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="1" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
                <div class="row">
                    @foreach($boxes as $box)
                        @if($box->place_id == 4)
                            <div class="col-3">
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

        <section id="facilities">
            <div class="container">
                <div class="row inline inline-tc">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <p data-modaleditor="2">{{ getInline($array, 2, 'modaleditor') }}</p>
                            <h2 data-modaltytul="2">{{ getInline($array, 2, 'modaltytul') }}</h2>
                        </div>
                    </div>
                    @auth
                        <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="2" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
                    @endauth
                </div>
                <div class="row">
                    @foreach($boxes as $box)
                        @if($box->place_id == 5)
                            <div class="col-3">
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

        <section id="benefits" class="p-0">
            <div class="container-fluid p-0">
                <div class="row no-gutters flex-row-reverse">
                    <div class="col-6">
                        <img src="{{ asset('/images/klub-korzysci.jpg') }}" alt="">
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="benefits-text">
                            <h2>Klub korzyści</h2>
                            <ul class="mb-0">
                                <li>strefa wodna</li>
                                <li>strefa rekreacyjno-wypoczynkowa</li>
                                <li>strefa sportu</li>
                                <li>strefa restauracyjna</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-6">
                        <img src="{{ asset('/images/usluga-concierge.jpg') }}" alt="">
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="benefits-text">
                            <h2>Usługa Concierge</h2>
                            <ul class="mb-0">
                                <li>sprzątanie</li>
                                <li>koszenie</li>
                                <li>odśnieżanie</li>
                                <li>rozpalenie w kominku</li>
                                <li>pranie</li>
                                <li>kosz ze śniadaniem pod drzwi</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters flex-row-reverse">
                    <div class="col-6">
                        <img src="{{ asset('/images/polec-nas.jpg') }}" alt="">
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="benefits-text">
                            <h2>Poleć nas i zyskaj!</h2>
                            <p>Z domów w Warmia Residence możesz korzystać na wiele sposobów – jest to idealne miejsce do mieszkania przez cały rok, ale nic nie stoi też na przeszkodzie, aby przekształcić to w dom letniskowy na wynajem. Dostosujemy się do Twoich indywidualnych potrzeb! Jeśli zainteresowała Cię nasza oferta i proponowane rozwiązania, to już teraz zapytaj o szczegóły zakupu lub poleć nas znajomym.</p>
                            <a href="" class="bttn mt-5 d-none">Więcej szczegółów</a>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-6">
                        <img src="{{ asset('/images/o-inwestorze.jpg') }}" alt="">
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="benefits-text">
                            <h2>O inwestorze</h2>
                            <p>Adept Investment Sp. z o.o. to inwestor i deweloper, który realizuje projekty na terenie Polski w segmencie obiektów handlowych, inwestycji mieszkaniowych oraz hoteli. W skład grupy kapitałowej Adept Investment Group wchodzą spółki zależne takie jak Adept Development – deweloper osiedli mieszkaniowych i apartamentowców, Adept Hotels – partner międzynarodowych sieci hotelarskich, a także Adept 24 – spółka odpowiedzialna za prace budowlane i wykończeniowe.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <section id="contact" class="blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="contact-text">
                        {!! $contact->content !!}
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
                        <div class="col-12 mt-4">
                            <div class="form-floating">
                                <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror" placeholder="">{{ old('form_message') }}</textarea>
                                <label for="form_message">@lang('cms.form-message') <span class="text-danger">*</span></label>
                                @error('form_message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($rules as $r)
                            <div class="col-12 mt-4">
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

@endsection
@push('scripts')
    <script src="{{ asset('/js/validation.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('/js/'.$current_locale.'.js') }}" charset="utf-8"></script>
    <script src="{{ asset('/js/slick.min.js') }}" charset="utf-8"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".validateForm").validationEngine({
                validateNonVisibleFields: true,
                updatePromptsPosition:true,
                promptPosition : "topRight:-137px"
            });

            $('#slider ul').responsiveSlides(
                {
                    auto:true,
                    pager:true,
                    nav:false,
                    timeout:4000,
                    random:false,
                    speed: 500,
                    before: function(){
                        //
                    },
                    after: function(){
                        //
                    }
                });

            $("#gallery-carousel").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                centerMode: true,
                centerPadding: '260px',
            });
            $(".filter span").on('click', function(){
                $(".filter span").removeClass('bttn-active');
                $(this).addClass('bttn-active');
                const filter = $(this).data('filter');
                $("#gallery-carousel").slick('slickUnfilter');

                @foreach($galleries as $gallery)
                    @if($gallery->photos_count > 0)
                    if(filter === 'gallery-{{$gallery->id}}'){
                        $("#gallery-carousel").slick('slickFilter','.gallery-{{$gallery->id}}');
                    }
                    @endif
                @endforeach
                if(filter === 'all'){
                    $("#gallery-carousel").slick('slickUnfilter');
                }

            })
        });
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