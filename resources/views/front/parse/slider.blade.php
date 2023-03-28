<div class="textSlider pt-5 pb-5">
    <ul class="list-unstyled mb-0">
        @foreach ($list as $p)
            <li>
                <a href="{{ asset('/uploads/gallery/images/'.$p->file) }}" class="swipebox" data-fslightbox="gallery-{{ $p->gallery_id }}" title="">
                <picture>
                    <source srcset="{{ asset('/uploads/gallery/images/thumbs/webp/'.$p->file_webp) }}" type="image/webp">
                    <source srcset="{{ asset('/uploads/gallery/images/thumbs/'.$p->file) }}" type="image/jpeg">
                    <img src="{{ asset('/uploads/gallery/images/thumbs/'.$p->file) }}" alt="{{ $p->name }}" loading="lazy" width="676" height="507" class="w-100">
                </picture>
                </a>
            </li>
        @endforeach
    </ul>
</div>
