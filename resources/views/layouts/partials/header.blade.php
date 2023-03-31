<div class="header-holder">
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div id="logo">
                        <a href="/">
                            <img src="{{ asset('/images/logo.svg') }}" alt="{{ settings()->get("page_title") }}">
                        </a>
                    </div>
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="top">
                                <ul class="mb-0 list-unstyled">
                                    <li><a href="tel:+48512655888">+48 512 655 888</a></li>
                                    <li><a href="tel:+48797055188">+48 797 055 188</a></li>
                                    <li><a href="mailto:l.dawiec@warmiaresort.pl">@lang('cms.header-email-cta')</a></li>
                                    <li class="sep">
                                        <a href="{{ changeLang('pl') }}" class="@if($current_locale == "pl") active @endif lang me-2">PL</a>
                                        <a href="{{ changeLang('en') }}" class="@if($current_locale == "en") active @endif lang">EN</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <nav>
                                <ul class="mb-0 list-unstyled">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ route('plan') }}">@lang('cms.menu-plan')</a></li>
                                    <li><a href="{{ route('location') }}">@lang('cms.menu-location')</a></li>
                                    <li><a href="{{ route('gallery') }}">@lang('cms.menu-gallery')</a></li>
                                    <li><a href="">@lang('cms.menu-client')</a></li>
                                    <li><a href="{{ route('contact') }}">@lang('cms.menu-contact')</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>

<aside>
    <ul class="mb-0 list-unstyled">
        <li><a href="https://www.facebook.com/WarmiaResidence" target="_blank"><span><i class="lab la-facebook-f"></i></span></a></li>
        <li><a href="https://www.instagram.com/warmia_residence/" target="_blank"><span><i class="lab la-instagram"></i></span></a></li>
        <li><a href="https://www.facebook.com/WarmiaResidence" target="_blank"><span><i class="lab la-youtube"></i></span></a></li>
    </ul>
</aside>
