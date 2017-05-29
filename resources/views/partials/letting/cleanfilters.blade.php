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
    <div class="l-advert">
        <a href="{{action('Web\LettingController@View', ['id' => $letting->PropertyId])}}" class="wrapper-img-advert">
            <span class="glyphicon glyphicon-eye-open"></span>
        </a>
        <div class="l-advert-img">
            <div class="l-advert-price"><span>&pound; {{intval($letting->Price)}}</span></div>
            <div class="l-advert-star"><a href="{{action('Web\LettingController@View', ['id' => $letting->PropertyId])}}"><span class="glyphicon glyphicon-eye-open"></span></a></div>
            @if($letting->MainPhoto != null)
            {{Html::image('img/Properties/Thumbnails/'.$letting->MainPhoto.'.jpg',null,['class'=>'img-responsive'])}}
            @else
            {{Html::image('img/no_property_pic.jpg',null,['class'=>'img-responsive'])}}
            @endif
        </div>
        <div class="l-advert-name">
            <span>{{$letting->ShortAddress}}, {{$letting->PostCode}}</span>
        </div>
        <div class="l-advert-data">
            <div class="l-type-house">
                <div class="l-type-house-img">
                    <div class="property-icon">
                        @if(Strings::PropertyName($letting->TypeProperty) == 'flatapartment')
                            {{ Html::image('img/icons/flat.png') }}
                        @elseif(Strings::PropertyName($letting->TypeProperty) == 'house')
                            {{ Html::image('img/icons/house.png') }}
                        @else
                            {{ Html::image('img/icons/apartment.png') }}
                        @endif
                    </div>
                    <div class="type-property">
                        <span>{{Strings::SplitCapitalizeString($letting->TypeProperty)}}</span>
                    </div>
                </div>
                <div class="furnished"><span>{{$letting->Furnished}}</span></div>
            </div>
            <div class="l-house-data">
                <div class="l-house-data-item">
                    <div class="l-house-data-item-icon-bed"></div>
                    <div class="l-house-data-item-number">{{$letting->TotalBedrooms}}</div>
                </div>
                <div class="l-house-data-item">
                    <div class="l-house-data-item-icon-shower"></div>
                    <div class="l-house-data-item-number">{{$letting->TotalBedrooms}}</div>
                </div>
                <div class="l-house-data-item">
                    <div class="l-house-data-item-icon-sofa"></div>
                    <div class="l-house-data-item-number">{{$letting->TotalRooms}}</div>
                </div>
                <div class="l-house-data-item">
                    <div class="l-house-data-item-icon-car"></div>
                    <div class="l-house-data-item-number">{{$letting->TotalGarages}}</div>
                </div>
            </div>
        </div>
        <div class="l-house-summary">
            <hr class="l-house-summary-line">
            <div class="l-house-summary-group-items">
                <div class="button-square-white" id="tab-area-name" data-area-id="{{$letting->AreaId}}"><span>{{$letting->AreaName}}</span></div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <h2 class="no-properties">0 PROPERTIES...</h2>
    @endif
    @if($data["pagination"]->total_pages > 1)
    <div class="l-pagination">
        <nav>
            <ul class="pagination">
                @if(1 < $data["pagination"]->limit_inf)
                <li class="page-item"><a data-page="1" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=1"}}">First</a></li>
                @endif
                @if($data["pagination"]->pag_actual > 1)
                <li class="page-item"><a data-page="{{intval($data["pagination"]->pag_actual) - 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($data["pagination"]->pag_actual) - 1)}}">Prev</a></li>
                @endif
                @for($i=$data["pagination"]->limit_inf; $i <= $data["pagination"]->limit_sup; $i++)
                @if($i == $data["pagination"]->pag_actual)
                <li class="page-item"><a data-page="{{$i}}" class="page-link actual-page" href="{{action('Web\LettingController@FilterLettings')."?page=".$i}}" id="page_link">{{$i}}</a></li>
                @else
                <li class="page-item"><a data-page="{{$i}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".$i}}" id="page_link">{{$i}}</a></li>
                @endif
                @endfor
                @if($data["pagination"]->limit_sup != $data["pagination"]->total_pages)
                <li class="page-item"><a data-page="{{intval($data["pagination"]->limit_sup) + 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($data["pagination"]->limit_sup) + 1)}}">...</a></li>
                @endif
                @if($data["pagination"]->pag_actual < $data["pagination"]->total_pages)
                <li class="page-item"><a data-page="{{intval($data["pagination"]->pag_actual) + 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($data["pagination"]->pag_actual) + 1)}}">Next</a></li>
                @endif
                @if($data["pagination"]->limit_sup < $data["pagination"]->total_pages)
                <li class="page-item"><a data-page="{{$data["pagination"]->total_pages}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".$data["pagination"]->total_pages}}">Last</a></li>
                @endif
            </ul>
        </nav>		
    </div>
    @endif
</div>