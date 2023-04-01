<div id="photos-list" class="container pt-3 pt-sm-5 pb-3 pb-sm-5">
    <div class="row d-flex justify-content-center">
        @foreach ($list as $p)
        <div class="col-6 col-lg-4">
            <div class="col-gallery-thumb">
                <a href="{{ asset('/uploads/gallery/images/'.$p->file) }}" class="swipebox" data-fslightbox="gallery-{{ $p->gallery_id }}" title="">
                    <picture>
                        <source srcset="{{ asset('/uploads/gallery/images/thumbs/webp/'.$p->file_webp) }}" type="image/webp">
                        <source srcset="{{ asset('/uploads/gallery/images/thumbs/'.$p->file) }}" type="image/jpeg">
                        <img src="{{ asset('/uploads/gallery/images/thumbs/'.$p->file) }}" alt="{{ $p->name }}" loading="lazy" width="676" height="507" class="w-100">
                    </picture>
                    <div><i class="las la-search-plus"></i></div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
