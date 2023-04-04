@extends('layouts.page', ['body_class' => 'gallery'])

@section('meta_title', $article->title)
@section('seo_title', $article->meta_title)
@section('seo_description', $article->meta_description)
@section('seo_robots', $page->meta_robots)

@section('pageheader')
    @include('layouts.partials.developro-header', [
    'title' => ($article->content_header) ?: $article->title,
    'header_file' => 'rooms.jpg',
    'items' => $page
    ])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! parse_text($article->content_entry) !!}
                <p>&nbsp</p>
                {!! parse_text($article->content) !!}
            </div>
        </div>
    </div>
@endsection