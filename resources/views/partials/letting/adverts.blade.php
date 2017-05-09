<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=no">
        {{ Html::style('css/app.css') }}
        <link media="all" href={{URL::to('https://file.myfontastic.com/TKhv4HW6qV8tGeVkfgpQ8R/icons.css')}} rel="stylesheet"/>
    </head>
    <body>
        @foreach($lettings as &$letting)
            <div class="l-advert l-advert-modal-map">
                <a href="{{action('Web\LettingController@View', ['id' => $letting->PropertyId])}}" class="wrapper-img-advert" style="position:absolute;">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <div class="l-advert-img">
                    <div class="l-advert-price l-advert-price-modal-map"><span>&pound; {{intval($letting->Price)}}</span></div>
                    <div class="l-advert-star l-advert-star-modal-map"><a href="{{action('Web\LettingController@View', ['id' => $letting->PropertyId])}}"><span class="glyphicon glyphicon-eye-open"></span></a></div>
                    @if($letting->MainPhoto != null)
                    {{Html::image('img/Properties/'.$letting->MainPhoto.'.jpg',null,['class'=>'img-responsive'])}}
                    @else
                    {{Html::image('img/no_property_pic.jpg',null,['class'=>'img-responsive'])}}
                    @endif
                </div>
                <div class="l-advert-name">
                    <span>{{$letting->ShortAddress}}, {{$letting->PostCode}}</span>
                </div>
                <div class="l-advert-data l-advert-data-modal-map">
                    <div class="l-type-house l-type-house-modal-map">
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
                    <div class="l-house-data l-house-data-modal-map">
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
                    <!--<hr class="l-house-summary-line">
                        <div class="l-house-summary-group-items">
                        <div class="button-square-white"><span>central location</span></div>
                        <div class="button-square-white"><span>deceptivly spacious</span></div>
                        <div class="button-square-white"><span>separate bathroom</span></div>
                        <div class="button-rounded-white"><span>fees apply</span></div>		
                    </div>-->
                </div>
            </div>
        @endforeach
    </body>
</html>

