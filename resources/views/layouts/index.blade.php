<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=no">
        @if (file_exists('css/app.min.css'))
            {{ Html::style('css/app.min.css') }}
        @else
            {{ Html::style('css/app.css') }}
        @endif
        <link media="all" href={{URL::to('https://file.myfontastic.com/TKhv4HW6qV8tGeVkfgpQ8R/icons.css')}} rel="stylesheet"/>
        <link rel="icon" type="img/ico" href="/img/icons/favicon.ico">
        <title>Passion For Properties</title>
        @yield('canonical')
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-766834-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{config("myparametersconfig.google_api_key")}}" async defer></script>
        @if (file_exists('js/app.min.js'))
            {{ Html::script('js/app.min.js')}}
        @else
            {{ Html::script('js/vendors/jquery.js')}}
            {{ Html::script('js/vendors/jquery-ui.js')}}
            {{ Html::script('js/vendors/jquery-cookie.js')}}
            {{ Html::script('js/vendors/bootstrap.js')}}
            {{ Html::script('js/init.js')}}
            {{ Html::script('js/home.js')}}
            {{ Html::script('js/footer.js')}}
            {{ Html::script('js/letting.js')}}
        @endif
        <script>
               $.ajaxSetup({ headers: { 'X-XSRF-TOKEN' : '{{ csrf_token() }}' } });
        </script>
    </head>
    <body ontouchstart="">
        <input type="hidden" value="{{$data['limitminprice']}}" id="input_minprice"/>
        <input type="hidden" value="{{$data['limitmaxprice']}}" id="input_maxprice"/>
        @if($data['queryfilter'] !== "")
        <input type="hidden" value="{{$data['queryfilter']}}" id="queryfilter"/>
        @else
        <input type="hidden" value="" id="queryfilter"/>
        @endif

        <div id="separator"></div>
        <div class="wrapper container-fluid" id="wrapper">
            <div class="wrapper-back-black wrapper-back-black-init"></div>

            <!--MOBILE MENU-->

            <div class="mobile-menu">
                <div class="mobile-menu-header">
                    <div class="mobile-menu-header-row">
                        <span class="mobile-menu-header-right-arrow icon-angle-right"></span>
                        <ol class="mobile-menu-header-list">
                            <li class="mobile-menu-header-list-item">
                                MENU
                            </li>
                            <li class="mobile-menu-header-list-item">
                                <span class="icon-bars"></span>
                            </li>
                        </ol>	
                    </div>
                </div>
                <ul class="menu-nav-mobile">
                    <li class="menu-nav-item-mobile">
                        <a href="{{action('Web\HomeController@Home')}}">HOME</a>
                    </li>
                    <li class="menu-nav-item-mobile">
                        <a href="{{action('Web\HomeController@Landlords')}}">landlords</a>
                    </li>
                    <li class="menu-nav-item-mobile">
                        <a href="{{action('Web\HomeController@Information')}}">information</a>
                    </li>
                    <li class="menu-nav-item-mobile">
                        <a href="http://www.chestershortlets.com/">serviced accomodation</a>
                    </li>
                    <li class="menu-nav-item-mobile">
                        <a href="{{action('Web\HomeController@Aboutus')}}">about us</a>
                    </li>
                    <!--<li class="menu-nav-item-mobile">
                        <a href="{{action('Web\HomeController@News')}}">news</a>
                    </li>-->
                </ul>
                <div class="button-rounded-red margin-auto">
                    <span>SIGN IN / SIGN UP</span>
                </div>
            </div>

            <!--END MOBILE MENU-->

            <!--FILTER MOBILE MENU-->

            <div class="filter-menu filter-menu-mobile hidden-md hidden-lg">
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
                        <span class="filter-menu-left-arrow icon-angle-left"></span>	
                    </div>
                </div>
                <div class="l-filter-menu">
                    <div class="filter-group">
                        <div class="filter-menu-labels">TYPE PROPERTY</div>
                        <div class="filter-menu-input-group" >
                            <select class="form-control my-select" id="type-property-mob">
                                <option value="">--Select a type--</option>
                                @foreach($data['type_properties'] as &$property)
                                <option value="{{strtolower($property['PropertyType'])}}">{{$property['PropertyType']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="filter-group">
                        <div class="filter-menu-labels">AREAS</div>
                        <select class="form-control my-select" id="location-mob">
                            <option value>--Any Area--</option>
                            @foreach($data['areas'] as &$area)
                            <option value="{{strtolower($area['id'])}}">{{$area['Name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <div class="l-prices-label">
                            <div class="filter-menu-labels">PRICE</div>
                            <div class="filter-menu-labels"><span id="mobile-min-price">&pound; {{$data['minprice']}}</span><span> - </span><span id="mobile-max-price">&pound; {{$data['maxprice']}}</span></div>
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
                            <span class="icon-trash-bin" id="filterclean_mob"></span>
                            <a href="{{action('Web\LettingController@FilterLettings')."?"}}" id="apply_filter_link_mob">
                                <div class="button-rounded-red filter-menu-group-item apply-filter">&#10004;APPLY FILTERS</div>
                            </a>
                        </div>
                    </div>	
                </div>
            </div>

            <!--END FILTER MOBILE MENU-->

            <!--HEADER-->

            <header class="l-header row" id="header">
                <div class="l-header-first-row">
                    <div class="visible-xs visible-sm">
                        <span class="icon-slider rotate" id="show-menu-filter"></span>
                    </div>
                    <div class="l-main-logo">
                        <a href="{{action('Web\HomeController@Home')}}">{{ Html::image('img/logo.png',null,['class'=>'img-responsive main-logo']) }}</a>
                    </div>
                    <div class="visible-xs visible-sm ">
                        <span class="icon-bars" id="show-menu-mobile"></span>
                    </div>
                    <!--<div class="button-rounded-red visible-md visible-lg"><span>SIGN IN / SIGN UP</span></div>-->
                </div>
                <nav class="main-nav">
                    <ul class="menu-nav">
                        <li class="menu-nav-item">
                            <a href="{{action('Web\HomeController@Home')}}">HOME</a>
                        </li>
                        <li class="menu-nav-item">
                            <a href="{{action('Web\HomeController@Landlords')}}">landlords</a>
                        </li>
                        <li class="menu-nav-item">
                            <a href="{{action('Web\HomeController@Information')}}">information</a>
                        </li>
                        <li class="menu-nav-item">
                            <a href="http://www.chestershortlets.com/">serviced accomodation</a>
                        </li>
                        <li class="menu-nav-item">
                            <a href="{{action('Web\HomeController@Aboutus')}}">about us</a>
                        </li>
                        <!--<li class="menu-nav-item">
                            <a href="{{action('Web\HomeController@News')}}">news</a>
                        </li>-->
                    </ul>	
                </nav>
            </header>

            <!--END HEADER-->

            <!--SLIDES-->

            <section class="row l-slides" id="slides">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            {{ Html::image('img/slides/apartment.jpg') }}
                        </div>

                        <div class="item">
                            {{ Html::image('img/slides/attention.jpg') }}
                        </div>

                        <div class="item">
                            {{ Html::image('img/slides/corporate.jpg') }}
                        </div>

                        <div class="item">
                            {{ Html::image('img/slides/M_3.jpg') }}
                        </div>
                    </div>
                </div>
            </section>

            <!--END SLIDES-->

            @yield('content')

        </div>

    </body>

    <!--FOOTER-->

    <footer>
        <section class="l-section-bottom-data">
            <div class="l-section-bottom-data-links">
                <a id="contactus" class="selected-red">Contact us</a>
                <a id="openinghours">Opening hours</a>
                <a id="emailform">Email form</a>
            </div>
            <div class="l-section-bottom-data-contactus show-flex" data-target="contactus">
                <div>
                    <span class="icon-phone"></span><span>+44 (0)1244 35000000</span>
                </div>
                <div>
                    <span class="icon-email"></span><span>info@passionforproperty.com</span>
                </div>
                <div>
                    <span class="icon-ptint"></span><span>+44 (0)1244 350311</span>
                </div>
                <div>
                    <span class="icon-map-pin"></span><span>info@passionforproperty.com</span>
                </div>
            </div>
            <div class="l-section-bottom-data-openinghours" data-target="openinghours">
                <div>
                    <span>Monday - Friday</span><span>09:00 - 17:00</span>
                </div>
                <div>
                    <span>Saturday</span><span>09:00 - 15:00</span>
                </div>
                <div>
                    <span>Sunday</span><span>Closed</span>
                </div>
            </div>
            <div class="contactform" data-target="emailform">
                <form id="form_message">
                    <div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your name" name="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email address" name="Email">
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Telephone number" name="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" name="Subject">
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message" rows=4 cols=20 name="Message"></textarea>
                            <div class="button-rounded-red max-width" id="sendcontactmessage">&#62;&nbsp;&nbsp;SEND</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="l-section-bottom-data-image">
                {{ Html::image('img/buildings.png',null,['class'=>'img-responsive']) }}
            </div>
        </section>
        <section class="l-breadcrumbs">
            <div>Passion For Property &#9400; 2017</div>
            <ul>
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-facebook"></span></a></li>
            </ul>
        </section>
    </footer>

            <!--END FOOTER-->
        </div>
    </body>

    <!--END FOOTER-->

</html>
