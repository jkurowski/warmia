@extends('layouts.page', ['body_class' => 'client-area'])

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
    <section id="benefits" class="p-0">
        <div class="container-fluid p-0">
            @foreach($list as $article)
            <div class="@if($loop->iteration % 2 == 0) row @else row flex-row-reverse @endif no-gutters">
                <div class="col-12 col-lg-6">
                    <picture>
                        <source srcset="{{ asset('/uploads/articles/thumbs/webp/'.$article->file_webp) }}" type="image/webp">
                        <source srcset="{{ asset('/uploads/articles/thumbs/'.$article->file) }}" type="image/jpeg">
                        <img src="{{ asset('/uploads/articles/thumbs/'.$article->file) }}" alt="Obrazek galerii" loading="lazy" width="792" height="594">
                    </picture>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
                    <div class="benefits-text">
                        <h2>{{ $article->title }}</h2>
                        {!! $article->content_entry !!}
                        @if($article->content)
                            <a href="{{ route('client.show', $article->slug) }}" class="bttn mt-3 mt-sm-5">CZYTAJ WIĘCEJ</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection