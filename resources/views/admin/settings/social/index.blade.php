@extends('admin.settings.index')

@section('settings')
<form method="POST" action="{{route('admin.settings.social.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid p-0">
        <div class="card p-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-12">
                        @include('form-elements.html-input-url', ['label' => 'Facebook', 'name' => 'social_facebook', 'value' => settings()->get("social_facebook")])
                        @include('form-elements.html-input-url', ['label' => 'Instagram', 'name' => 'social_instagram', 'value' => settings()->get("social_instagram")])
                        @include('form-elements.html-input-url', ['label' => 'Twitter', 'name' => 'social_twitter', 'value' => settings()->get("social_twitter")])
                        @include('form-elements.html-input-url', ['label' => 'Linkedin', 'name' => 'social_linkedin', 'value' => settings()->get("social_linkedin")])
                        @include('form-elements.html-input-url', ['label' => 'Youtube', 'name' => 'social_youtube', 'value' => settings()->get("social_youtube")])
                        @include('form-elements.html-input-url', ['label' => 'Vimeo', 'name' => 'social_vimeo', 'value' => settings()->get("social_vimeo")])
                    </div>
                </div>

                <div class="section">
                    <div class="row">
                        <div class="col-12">
                            Protokół Open Graph
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 text-end">
                                <label for="#graph" class="col-form-label control-label flex-wrap">
                                    <code class="d-block">og:image</code>
                                    <span>.jpg, 600 px / 314 px</span>
                                </label>
                            </div>
                            <div class="col-6">
                                <div id="graph">
                                    <img src="{{ asset('uploads/share/website_share.jpg') }}" alt="og:image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @include('form-elements.html-input-text-count', ['label' => '<code class="d-block">og:title</code><span>ilość znaków: 60 - 90</span>', 'name' => 'og_title', 'value' => settings()->get("og_title"), 'maxlength' => 90])
                    @include('form-elements.html-input-text-count', ['label' => '<code class="d-block">og:description</code><span>ilość znaków: 180 - 200</span>', 'name' => 'og_description', 'value' => settings()->get("og_description"), 'maxlength' => 200])
                    @include('form-elements.html-input-text', ['label' => '<code class="d-block">og:type</code><span>website, blog, company</span>', 'name' => 'og_type', 'value' => settings()->get("og_type")])
                    @include('form-elements.html-input-file', ['label' => '<code class="d-block">og:file</code>', 'sublabel' => '(wymiary: 600 px / 314 px)', 'name' => 'og_file', 'value' => settings()->get("og_file")])
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 text-end">

                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-group-submit">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <input name="submit" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
    <script>
        @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-bottom-right",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
        $(document).ready(function(){
            $( ".input-url .form-control" ).each(function() {
                if($( this ).val()) {
                    $( this ).next( ".input-group-append" ).removeClass('d-none').addClass('d-block');
                }
            });
            $( ".input-group-append button" ).click(function() {
                const url = $( this ).offsetParent().children('input').val();
                window.open(url, '_blank');
            });
        });
    </script>
@endpush
