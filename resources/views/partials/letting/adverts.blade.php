<div class="l-advert">
    <a href="{{action('Web\LettingController@View', ['id' => $letting->PropertyId])}}" class="wrapper-img-advert">
        <span class="glyphicon glyphicon-eye-open"></span>
    </a>
    <div class="l-advert-img">
        <div class="l-advert-price"><span>&pound; {{intval($letting->Price)}}</span></div>
        <div class="l-advert-star"><a href="/propertyview.html"><span class="glyphicon glyphicon-eye-open"></span></a></div>
        @if($letting->MainPhoto != null)
        {{Html::image('img/Properties/'.$letting->MainPhoto.'.jpg',null,['class'=>'img-responsive'])}}
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
                <div>
                    {{ Html::image('img/icons/apartment.png') }}
                </div>
                <div class="type-property">
                    <span>{{$letting->TypeProperty}}</span>
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
        <!--<div class="l-house-summary-group-items">
            <div class="button-square-white"><span>central location</span></div>
            <div class="button-square-white"><span>deceptivly spacious</span></div>
            <div class="button-square-white"><span>separate bathroom</span></div>
            <div class="button-rounded-white"><span>fees apply</span></div>		
        </div>-->
    </div>
</div>
