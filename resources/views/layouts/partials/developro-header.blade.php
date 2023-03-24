<div id="page-header" style="background:#252b54 url('{{ asset('/uploads/slider/slider-1.jpg') }}') no-repeat bottom center">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-end justify-content-center">
                <div class="page-header-content">
                    <div>
                        <h1>{{ $title }}</h1>
                        @include('layouts.partials.breadcrumbs', ['items' => $items, 'title' => $title])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
