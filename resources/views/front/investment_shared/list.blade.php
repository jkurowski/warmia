<div id="roomsList">
    <div class="container p-0">
        @if($properties->count() > 0)
            @foreach($properties as $room)
                <div class="row m-0">
                    @if($room->price)
                        <span class="ribbon1"><span>@lang('cms.list-special-offer')</span></span>
                    @endif
                    <div class="col col-top p-0 align-items-center">
                        <h2><a href="{{route('property', $room)}}">{{$room->name}}</a></h2>
                    </div>
                    <div class="col justify-content-center">
                        @if($room->file)
                            <picture>
                                <source type="image/webp" srcset="/investment/property/list/webp/{{$room->file_webp}}">
                                <source type="image/jpeg" srcset="/investment/property/list/{{$room->file}}">
                                <img src="/investment/property/list/{{$room->file}}" alt="{{$room->name}}">
                            </picture>
                        @endif
                    </div>
                    <div class="col pe-3 pe-lg-5">
                        <ul class="mb-0 list-unstyled">
                            @if($room->price)
                                <li>@lang('cms.list-small-price'): <b>@money($room->price)</b></li>
                            @endif
                            <li>@lang('cms.list-small-rooms'): <b>{{$room->rooms}}</b></li>
                            <li>@lang('cms.list-small-area'): <b>{{$room->area}} m<sup>2</sup></b></li>
                            @if($room->garden_area)
                            <li>@lang('cms.list-small-landarea'): <b>{{$room->garden_area}} m<sup>2</sup></b></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col justify-content-center">
                        <span class="badge room-list-status-{{ $room->status }}">{{ roomStatus($room->status) }}</span>
                    </div>
                    <div class="col justify-content-end col-list-btn p-0">
                        <a href="{{route('property', $room)}}" class="bttn bttn-border">@lang('cms.list-bttn')</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-12 text-center pt-4 pb-4">
                    <b>@lang('cms.list-no-results')</b>
                </div>
            </div>
        @endif
    </div>
</div>