<div class="filter-menu">
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
            <!--<span class="filter-menu-left-arrow icon-angle-left"></span>-->
        </div>
    </div>
    <div class="l-filter-menu">
        <div class="filter-group">
            <div class="filter-menu-labels">TYPE PROPERTY</div>
            <div class="ui fluid multiple search selection dropdown" id="type-property">
                <i class="dropdown icon"></i>
                <div class="default text">Type Property</div>
                <div class="menu">
                    @foreach($data['type_properties'] as &$property)
                    <div class="item" data-value="{{Strings::StrToLower($property['PropertyType'])}}">{{Strings::SplitCapitalizeString($property['PropertyType'])}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="filter-group">
            <div class="filter-menu-labels">AREAS</div>
            <div class="ui fluid multiple search selection dropdown" id="location">
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
                <span id="filterclean" class="icon-trash-bin"></span>
                <a href="{{action('Web\LettingController@FilterLettings')."?"}}" id="apply_filter_link">
                    <div class="button-rounded-red filter-menu-group-item apply-filter"><i class="icon-tick"></i> APPLY FILTERS</div>
                </a>
            </div>
        </div>	
    </div>
</div>	