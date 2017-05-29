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