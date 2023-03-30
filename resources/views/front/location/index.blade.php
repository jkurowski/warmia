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
                <div class="col-6">
                    <div class="row">
                        @foreach($boxes as $box)
                            @if($box->gallery_id == 6)
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
                    @if($box->gallery_id == 7)
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

    <section id="bike">
        <div class="apla inline inline-tc">
            <h2 data-modaltytul="11">{!! getInline($array, 11, 'modaltytul') !!}</h2>
            <p data-modaleditor="11">{{ getInline($array, 11, 'modaleditor') }}</p>
            @auth
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="11" data-hideinput="modallink,modallinkbutton,modaleditortext,file,file_alt" data-method="update" data-imgwidth="796" data-imgheight="738"></button></div>
            @endauth
        </div>
    </section>

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
                                <label for="form_name">Imię <span class="text-danger">*</span></label>
                                @error('form_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_email" id="form_email" class="validate[required,custom[email]] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}" placeholder="">
                                <label for="form_email">E-mail <span class="text-danger">*</span></label>
                                @error('form_email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            <div class="form-floating">
                                <input name="form_phone" id="form_phone" class="validate[required,custom[phone]] form-control @error('form_phone') is-invalid @enderror" type="text" value="{{ old('form_phone') }}" placeholder="">
                                <label for="form_phone">Telefon <span class="text-danger">*</span></label>
                                @error('form_phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-floating">
                                <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror" placeholder="">{{ old('form_message') }}</textarea>
                                <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
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
                                document.write("<button class=\"bttn\" type=\"submit\">Wyślij wiadomość</button>");
                            </script>
                            <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('/js/validation.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/pl.js') }}" charset="utf-8"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".validateForm").validationEngine({
                    validateNonVisibleFields: true,
                    updatePromptsPosition:true,
                    promptPosition : "topRight:-137px"
                });

                $("#gallery-carousel").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    centerMode: true,
                    centerPadding: '260px',
                });
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
@endsection