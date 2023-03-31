@extends('layouts.page', ['body_class' => 'subpage'])

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
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! parse_text($page->content) !!}
            </div>
        </div>
    </div>
@endsection
