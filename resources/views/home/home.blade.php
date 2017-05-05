@extends('layouts.index')

@section('canonical')

@if($data['pagination']->pag_actual > 1)
<link rel="canonical" href="{{URL::to('/')."/?page=".$data['pagination']->pag_actual}}">
@else
<link rel="canonical" href="{{URL::to('/')."/"}}">
@endif

@if($data['pagination']->pag_actual > 1)
@if(($data['pagination']->pag_actual - 1) === 1)
<link rel="prev" href="{{URL::to('/')."/"}}">
@else
<link rel="prev" href="{{URL::to('/')."/?page=".($data['pagination']->pag_actual - 1)}}">
@endif
@endif

@if($data['pagination']->pag_actual < $data['pagination']->total_pages)
<link rel="next" href="{{URL::to('/')."/?page=".($data['pagination']->pag_actual + 1)}}">
@endif

@endsection

@section('content')

<div class="modal fade" id="modal-map">
    <div class="modal-dialog margin-auto" role="document" style="width: 80%;top:17em;">
        <div class="modal-content l-modal-content">
            <div class="modal-body no-padding">
                <div style="padding:2em;">
                    <div class="home-map" id="home-map" style="height: 500px;margin:0 auto;box-shadow: 10px 10px 5px #888888;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="row main">
    <aside class="col-xs-12 col-sm-12 col-md-3 visible-md visible-lg">
        <div class="filter-menu">
            <div class="filter-menu-header">
                <div class="filter-menu-header-row">
                    <ol class="filter-menu-header-list no-padding">
                        <li class="filter-menu-header-list-item">
                            <span class="icon-slider rotate"></span>
                        </li>
                        <li class="filter-menu-header-list-item">
                            FILTERS
                        </li>
                    </ol>
                    <!--<span class="filter-menu-left-arrow icon-angle-left"></span>-->
                </div>
            </div>
            <div class="l-filter-menu">
                <div class="filter-group">
                    <div class="filter-menu-labels">TYPE PROPERTY</div>
                    <div class="filter-menu-input-group">
                        <select class="form-control my-select" id="type-property">
                            <option value="">--Select a type--</option>
                            @foreach($data['type_properties'] as &$property)
                            <option value="{{strtolower($property['PropertyType'])}}">{{$property['PropertyType']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="filter-group">
                    <div class="filter-menu-labels">AREAS</div>
                    <select class="form-control my-select" id="location">
                        <option value>--Any Area--</option>
                        @foreach($data['areas'] as &$area)
                        <option value="{{strtolower($area['id'])}}">{{$area['Name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <div class="l-prices-label">
                        <div class="filter-menu-labels">PRICE</div>
                        <div class="filter-menu-labels"><span id="min-price">&pound; {{$data['minprice']}}</span><span> - </span><span id="max-price">&pound; {{$data['maxprice']}}</span></div>
                    </div>
                    <div id="slider-range" class="slide-range"></div>
                </div>
                <div class="filter-group">
                    <div class="filter-menu-labels">MIN NUMBER OF BEDS</div>
                    <div class="filter-menu-input-group" id="numbeds">
                        @for($i=1;$i<=5;$i++)
                        <div class="button-circle-white filter-menu-group-item">{{$i}}</div>
                        @endfor    
                    </div>							
                </div>
                <div class="filter-group">
                    <div class="filter-menu-labels">FURNISHING</div>
                    <div class="filter-menu-input-group" id="furnished">
                        <div class="button-rounded-white filter-menu-group-item" data-value="furnished">Furnished</div>
                        <div class="button-rounded-white filter-menu-group-item" data-value="unfurnished">Unfurnished</div>
                    </div>
                </div>
                <div class="filter-group">
                    <div class="filter-menu-input-group">
                        <span class="icon-trash-bin" id="filterclean"></span>
                        <a href="{{action('Web\LettingController@FilterLettings')."?"}}" id="apply_filter_link">
                            <div class="button-rounded-red filter-menu-group-item apply-filter">&#10004;APPLY FILTERS</div>
                        </a>
                    </div>
                </div>	
            </div>
        </div>	
    </aside>
    <section class="col-xs-12 col-sm-12 col-md-9">
        <div class="l-results">
            <ul class="results-list">
                <li class="results-list-item"><span>{{$data['total_lettings']}}</span> results</li>
                <li class="results-list-item hidden-xs hidden-sm">View</li>
                <li class="results-list-item hidden-xs hidden-sm" id="show-sprite"><span class="icon-thumbnails"></span></li>
                <li class="results-list-item hidden-xs hidden-sm" id="show-landscape"><span class="icon-bars"></span></li>
                <li class="results-list-item hidden-xs hidden-sm"><span data-toggle="modal" data-target="#modal-map" class="icon-map" id="open-map"></span></li>
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
            @endforeach
            @else
            <h2>0 PROPERTIES...</h2>
            @endif
            @if($data["pagination"]->total_pages > 1)
            <div class="l-pagination">
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a data-page="1" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=1"}}">First</a></li>
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
                        <li class="page-item"><a data-page="{{$data["pagination"]->total_pages}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".$data["pagination"]->total_pages}}">Last</a></li>
                    </ul>
                </nav>		
            </div>
            @endif
        </div>
    </section>		
</main>
@endsection