@extends('layouts.homepage')

@section('content')
    <section id="investment" class="pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-start">
                        <p>WORYTY NAD JEZIOREM GIŁWA</p>
                        <h2>Warmia Residence - enklawa <br>spokoju i luksusu</h2>
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
                    <div>
                        <p>Warmia Residence to miejsce stworzone z myślą o osobach, które poszukują nieruchomości premium. Klimatyczny i zarazem komfortowy dom z ogrodem, tarasem i pięknym widokiem to propozycja dla wymagających. Miejsce, gdzie można się wyciszyć, odpocząć i zrelaksować w komfortowych warunkach z dala od wielkiego miasta.</p>
                        <p>Dla właścicieli domów oddajemy do dyspozycji prestiżową strefę relaksu. Odkryty basen, korty tenisowe, boisko multifunkcyjne, boisko do badmintona, mini golf i plac zabaw dla najmłodszych to udogodnienia, które są kwintesencją luksusu i komfortu, które oferuje Warmia Residence. To idealne miejsce do odpoczynku w eleganckich i klimatycznych okolicznościach.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="plan" class="pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Wybierz swoje miejsce</h2>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('/images/plan.jpg') }}" alt="Plan inwestycji">
    </section>

    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <p>TWÓJ DOM W OTOCZENIU NATURY</p>
                        <h2>Warmia Residence w pigułce</h2>
                    </div>
                </div>
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
            <div class="row">
                <div class="col-6">
                    <h2>Tutaj poczujesz się <br>jak w bajkowej krainie</h2>
                </div>
                <div class="col-6">
                    <p>Warmia Residence leży w sercu malowniczej krainy, która oferuje czyste powietrze, piękne krajobrazy, niezliczone jeziora i dziewicze lasy. Inwestycja znajduje się na terenie gminy Gietrzwałd, w miejscowości Woryty. Jest to drugi etap inwestycji Adept Investment Sp. z o.o. na Warmii. Pierwszy etap inwestycji to Warmia Resort - komfortowo wykończone Ville wypoczynkowe. Warmia Residence jest zlokalizowana zaledwie 20 km od Olsztyna, 25 km od Ostródy. Droga do Trójmiasta zajmuje ok 1h 30 minut, a do Warszawy 2h 15 minut. Niewątpliwym atutem lokalizacji jest jezioro Giłwa - oddalone o 300 metrów.</p>
                    <p>W pobliżu znajdują się liczne trasy pieszo-rowerowe, miejsca do uprawiania kajakarstwa i żeglarstwa oraz pole golfowe.</p>
                </div>
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
        <div class="apla">
            <h2>Twoje miejsce z dala <br>od wielkiego miasta</h2>
            <p>Warmia to jeden z najpiękniejszych regionów w Polsce. Przyroda zachwyca pięknymi jeziorami, łąkami i pachnącymi lasami. Na Warmii nie ma drugiego takiego miejsca jak Warmia Residence, to prestiżowy resort klimatycznych domów, gdzie malownicze krajobrazy i czyste powietrze łączą się z luksusowymi udogodnieniami.</p>
        </div>
    </section>

    <picture>
        <source srcset="{{ asset('/images/mapa.webp') }}" type="image/webp">
        <source srcset="{{ asset('/images/mapa.jpg') }}" type="image/jpeg">
        <img src="{{ asset('/images/mapa.jpg') }}" alt="Mapa okolicy i lokalizacja inwestycji" loading="lazy" width="1920" height="1123" class="w-100">
    </picture>

    <section id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <p>GALERIA</p>
                        <h2>Poznaj możliwości domów</h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div id="gallery-nav">
                        <ul class="list-unstyled mb-0 row">
                            <li class="col-3"><a href="" class="bttn bttn-border bttn-active">Wszystkie</a></li>
                            <li class="col-3"><a href="" class="bttn bttn-border">Wizualizacje</a></li>
                            <li class="col-3"><a href="" class="bttn bttn-border">Okolica</a></li>
                            <li class="col-3"><a href="" class="bttn bttn-border">Domy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="standards">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <p>ROZWIĄZANIA ZAPEWNIAJĄCE NAJWYŻSZY KOMFORT</p>
                        <h2>Standard inwestycji</h2>
                    </div>
                </div>
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
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <p>BY ŻYŁO SIĘ LEPIEJ!</p>
                        <h2>Udogodnienia</h2>
                    </div>
                </div>
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
                        <p>W Warmia Residence możesz mieszkać przez cały rok, wypoczywać, zaprosić przyjaciół lub wynająć swój dom i zarabiać. Sprawdź jak możemy Ci pomóc w uzyskaniu wymarzonego domu w trudnych czasach.</p>
                        <a href="" class="bttn mt-5">Więcej szczegółów</a>
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