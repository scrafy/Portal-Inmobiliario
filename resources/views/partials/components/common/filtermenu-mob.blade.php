<!--FILTER MOBILE MENU-->

<div class="filter-menu filter-menu-mobile /*hidden-md hidden-lg*/">
    <div class="filter-menu-header">
        <div class="filter-menu-header-row">
            <ol class="filter-menu-header-list no-padding">
                <li class="filter-menu-header-list-item">
                    <span class="icon-filters"></span>
                </li>
                <li class="filter-menu-header-list-item">
                    FILTERS
                </li>
            </ol>
            <span class="filter-menu-left-arrow icon-angle-left"></span>
        </div>
    </div>
    <div class="l-filter-menu">
        <div class="filter-group">
            <div class="filter-menu-labels">TYPE PROPERTY</div>
            <div class="ui fluid multiple search selection dropdown" id="type-property-mob">
                <i class="dropdown icon"></i>
                <div class="default text">Type Property</div>
                <div class="menu">
                    @foreach($data['type_properties'] as &$property)
                    <div class="item"
                         data-value="{{Strings::StrToLower($property['PropertyType'])}}">{{Strings::SplitCapitalizeString($property['PropertyType'])}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="filter-group">
            <div class="filter-menu-labels">AREAS</div>
            <div class="ui fluid multiple search selection dropdown" id="location-mob">
                <i class="dropdown icon"></i>
                <div class="default text">Area</div>
                <div class="menu">
                    @foreach($data['areas'] as &$area)
                    <div class="item" data-value="{{Strings::StrToLower($area['id'])}}">{{$area['Name']}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="filter-group">
            <div class="l-prices-label">
                <div class="filter-menu-labels">PRICE</div>
                <div class="filter-menu-labels"><span
                        id="mobile-min-price">&pound; {{$data['minprice']}}</span><span> - </span><span
                        id="mobile-max-price">&pound; {{$data['maxprice']}}</span></div>
            </div>
            <div id="filter-mobile-slider-range" class="slide-range"></div>
        </div>
        <div class="filter-group">
            <div class="filter-menu-labels">MIN NUMBER OF BEDS</div>
            <div class="filter-menu-input-group" id="numbeds-mob">
                @for($i=1;$i<=5;$i++)
                <div class="button-circle-white filter-menu-group-item">{{$i}}</div>
                @endfor
            </div>
        </div>
        <div class="filter-group">
            <div class="filter-menu-labels">FURNISHING</div>
            <div class="filter-menu-input-group" id="furnished-mob">
                <div class="button-rounded-white filter-menu-group-item" data-value="furnished">Furnished</div>
                <div class="button-rounded-white filter-menu-group-item" data-value="unfurnished">Unfurnished</div>
            </div>
        </div>
        <div class="filter-group">
            <div class="filter-menu-input-group">
                <span id="filterclean_mob" class="icon-trash-bin"></span>
                <a href="{{action('Web\LettingController@FilterLettings')."?"}}" id="apply_filter_link_mob">
                    <div class="button-rounded-red filter-menu-group-item apply-filter"><i class="icon-tick"></i>
                        APPLY FILTERS
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!--END FILTER MOBILE MENU-->