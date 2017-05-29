<div class="l-results">
    <ul class="results-list">
        <li class="results-list-item"><span>{{$data['total_lettings']}}</span> results</li>
        <li class="results-list-item hidden-xs hidden-sm">View</li>
        <li class="results-list-item hidden-xs" id="show-sprite"><a href="#" class="icon-thumbnails active"></a></li>
        <li class="results-list-item hidden-xs" id="show-landscape">
            {{--<a href="#" class="icon-bars"></a>--}}
        </li>
        <li class="results-list-item"><a href="#" data-toggle="modal" data-target="#modal-map" class="icon-map" id="open-map"></a></li>
    </ul>
    <div class="l-results-sortby">
        <span>Sort by</span>
    </div>
    <select id="select-order-by">
        <option value="pricelowtohigh">Price low to high</option>
        <option value="pricehightolow">Price high to low</option>
    </select>
</div>
<hr class="l-results-line">
<div class="l-adverts" id="l-adverts">
    @if(count($data['lettings']) > 0)
        @foreach($data['lettings'] as &$letting)
            @component('partials/components/letting/advert-tab', ['letting' => $letting])
            @endcomponent
        @endforeach
    @else
        <h2 class="no-properties">0 PROPERTIES...</h2>
    @endif
    @component('partials/components/common/pagination', ['pagination' => $data['pagination']])
    @endcomponent
</div>