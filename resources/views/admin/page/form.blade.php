@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.page.edit'))
        <form method="POST" action="{{route('admin.page.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.page.store')}}" enctype="multipart/form-data">
    @endif
    @csrf
        <div class="container">
            <div class="card-head container">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title"><i class="fe-file-text"></i><a href="{{route('admin.page.index')}}">Menu</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if(!Request::get('lang'))
                            @include('form-elements.html-select', ['label' => 'Status', 'name' => 'active', 'selected' => $entry->active, 'select' => ['1' => 'Pokaż na liście', '0' => 'Ukryj na liście']])
                            @include('form-elements.html-select', [
                                'label' => 'Podstrona',
                                'name' => 'parent_id',
                                'selected' => $entry->parent_id,
                                'select' => $selectMenu
                            ])
                            @endif
                            @include('form-elements.html-input-text', ['label' => 'Tytuł strony', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                            @include('form-elements.html-input-text', ['label' => 'Nagłówek H1', 'name' => 'content_header', 'value' => $entry->content_header])
                            @include('form-elements.html-input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                            @include('form-elements.html-input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                            @if(!Request::get('lang'))
                            @include('form-elements.html-input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                            @endif
                            @include('form-elements.textarea-fullwidth', ['label' => 'Wprowadź tekst', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" name="lang" value="{{$current_locale}}">
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
        @include('form-elements.tintmce')
@endsection
