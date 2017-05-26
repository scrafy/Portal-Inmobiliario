@extends('layouts.index', ['body_class' => 'property-view'])


@section('content')

<!--ARRANGE VIEW MODAL-->


<div class="modal fade l-arrangeview" id="arrangeview-modal">
    <div class="modal-dialog margin-auto" role="document">
        <div class="modal-content l-modal-content">
            <div class="modal-body no-padding">
                <div class="l-arrangeview-header">
                    <span class="glyphicon glyphicon-remove" data-dismiss="modal" id="close-arrange-form"></span>
                    <div>
                        <span class="glyphicon glyphicon-eye-open"></span>
                        <span>ARRANGE VIEWING</span>
                    </div>
                </div>
                <form id="form-arrange">
                    <input type="hidden" name="LettingId" value="{{$data['letting']->LettingId}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name=FirstName placeholder="First Name">
                        <span id="error-FirstName"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="LastName" placeholder="Surname">
                        <span id="error-LastName"></span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="Email" placeholder="Email">
                        <span id="error-Email"></span>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="Mobile" placeholder="Mobile">
                        <span id="error-Mobile"></span>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="Message" rows="3"></textarea>
                        <span id="error-Message"></span>
                    </div>	

                    <div class="separator-line form-group">

                    </div>
                    <div class="contact-me form-group">
                        <div class="form-group">
                            <span>Contact me by</span>
                        </div>
                        <div class="buttons">
                            <div class="button-rounded-white" id="no-contact"><span>N/A</span></div>
                            <div class="button-rounded-white" id="contact-by-phone"><span>Phone</span></div>
                            <div class="button-rounded-white" id="contact-by-email"><span>Email</span></div>
                        </div>
                        <span id="error-ContactBy"></span>
                    </div>
                    <div class="proposed-data form-group">
                        <div class="form-group">
                            <span>Proposed Date</span>
                        </div>
                        <div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="FirstDate" placeholder="1. date (yyyy-mm-dd hh:mm:ss)">
                                <span id="error-FirstDate"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="SecondDate" placeholder="2. date (yyyy-mm-dd hh:mm:ss)">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ThirdDate" placeholder="3. date (yyyy-mm-dd hh:mm:ss)">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="button-rounded-red margin-auto" id="submit-arrange-form">SUBMIT</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>	


<!--END ARRANGE VIEW MODAL-->

<!--EPC REPORT MODAL-->

<div class="modal fade l-epc-report" id="epcreport-modal">
    <div class="modal-dialog margin-auto" role="document">
        <div class="modal-content l-modal-content">
            <div class="modal-body no-padding">
                <div class="l-modal-header">
                    <span class="glyphicon glyphicon-remove" data-dismiss="modal"></span>
                    <div>
                        <span class="glyphicon glyphicon-refresh"></span>
                        <span>EPC REPORT</span>
                    </div>
                </div>
                <div class="l-body-epc">
                    <p class="title">For full Energy Perfomance Certificate, please contact our office.</p>
                    <p>
                        This home’s performance is rated in terms of the energy use per square metre of floor area, energy efficiency based on fuel costs and environmental impact based on carbon dioxide CO2 emissions.
                    </p>
                    <div class="l-report-img">
                        <img src="" class="img-responsive" id="epc-report-img">
                    </div>
                    <p>
                        The energy efficiency rating is a measure of the overall efficiency of a home. The higher the rating the more energy efficient the home is and the lower the fuel bills will be.
                    </p>	
                </div>
            </div>
        </div>
    </div>
</div>	


<!--END EPC REPORT MODAL-->

<!--FEES MODAL-->

<div class="modal fade l-fees" id="fees-modal">
    <div class="modal-dialog margin-auto" role="document">
        <div class="modal-content l-modal-content">
            <div class="modal-body no-padding">
                <div class="l-modal-header">
                    <span class="glyphicon glyphicon-remove" data-dismiss="modal"></span>
                    <div>
                        <span class="glyphicon glyphicon-usd"></span>
                        <span>FEES APPLY</span>
                    </div>
                </div>
                <div class="l-body-fees">
                    <p class="title">Letting fees information</p>
                    <p>
                        The asking rent does not include letting fees. Depending on your circumstances and the property you select, Passion for Property may also apply the following up front fees.
                    </p>
                    <ul>
                        <li>
                            Administration fees / Reference fees (including credit checks, bank, previous landlord, etc) covers up to 2 applicants - &pound; 285 per Application
                        </li>
                        <li>
                            Additional occupant fees -  &pound; 65
                        </li>
                        <li>
                            Guarantor arrangement/application fees -  &pound; 65
                        </li>
                        <li>
                            Pets disclaimer fees/additional pet deposit  &pound; 300 per Company let
                        </li>
                    </ul>
                    <p>
                        The above fees will be refunded if the Landlord withdraws from the let.<br>
                        In the event the tenant withdraws after paying the fees these will be non refundable.
                    </p>	
                </div>
            </div>
        </div>
    </div>
</div>	

<!--END FEES MODAL-->

<!--PROPERTY VIEW-->

<div class="row l-property-view">
    <section class="l-sec-property-view no-padding">
        <div class="l-sec-property-view-img">
            <div id="carousel-1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @if(count($data['letting']->Photos) > 0)
                    @php($first = true)
                    @php($cont = 0)
                    @foreach($data['letting']->Photos as &$photo)
                    @if($first)
                    <li data-target="#carousel-1" data-slide-to="{{$cont}}" class="active"></li>
                    {{$first = false}}
                    @else
                    <li data-target="#carousel-1" data-slide-to="{{$cont}}"></li>
                    @endif
                    <!--{{$cont++}}-->
                    @endforeach
                    @else
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    @endif
                </ol>
                <div class="carousel-inner" role="listbox">
                    @if(count($data['letting']->Photos) > 0)
                    @php($first = true)
                    @foreach($data['letting']->Photos as &$photo)
                    @if($first)
                    <div class="item active">
                        {{Html::image('img/Properties/'.$photo['id'].'.jpg',null,['class'=>'img-responsive'])}}
                    </div>
                    {{$first = false}}
                    @else
                    <div class="item">
                        {{Html::image('img/Properties/'.$photo['id'].'.jpg',null,['class'=>'img-responsive'])}}
                    </div>
                    @endif
                    @endforeach
                    @else 
                    <div class="item active">
                        {{Html::image('img/no_property_pic.jpg',null,['class'=>'img-responsive'])}}
                    </div>
                    @endif
                </div>
                <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <div class="l-advert-price"><span>&pound; {{intval($data['letting']->Price)}}</span></div>
        </div>
        <article class="hidden-xs hidden-sm">
            <p class="no-margin">
                {{$data['letting']->Description}}
            </p>
        </article>	
    </section>
    <aside class="l-aside-property-view no-padding">
        <div class="l-advert">
            <div class="l-advert-name">
                <span id="advert-address">{{$data['letting']->ShortAddress}}, {{$data['letting']->PostCode}}</span>
                <!--<span class="icon-star" style="font-size: 1.5em;font-weight: bold;"></span>-->
            </div>
            <ul>
                <li>
                    <span>Available </span><span>{{Strings::EnDateForNoTime($data['letting']->Start)}}</span>
                </li>
                <li>
                    <span>Deposit&nbsp;&nbsp;</span><span>&pound; {{intval($data['letting']->BondRequired)}}</span>
                </li>
            </ul>
            <div class="l-advert-data">
                <div class="l-type-house">
                    <div class="type-house-icon">
                        @if($data['letting']->TypeProperty == 'FlatApartment' || $data['letting']->TypeProperty == 'Flat Apartment')
                            {{ Html::image('img/icons/flat.png') }}
                        @elseif($data['letting']->TypeProperty == 'House')
                            {{ Html::image('img/icons/house.png') }}
                        @else
                            {{ Html::image('img/icons/apartment.png') }}
                        @endif
                    </div>
                    <div class="type-property">{{Strings::SplitCapitalizeString($data['letting']->TypeProperty)}}</div>
                    <div class="furnished">{{$data['letting']->Furnished}}</div>
                </div>
                <div class="l-house-data">
                    <div class="l-house-data-item">
                        <div class="l-house-data-item-icon-bed"></div>
                        <div class="l-house-data-item-number">{{$data['letting']->TotalBedrooms}}</div>
                    </div>
                    <div class="l-house-data-item">
                        <div class="l-house-data-item-icon-shower"></div>
                        <div class="l-house-data-item-number">{{$data['letting']->TotalBathrooms}}</div>
                    </div>
                    <div class="l-house-data-item">
                        <div class="l-house-data-item-icon-sofa"></div>
                        <div class="l-house-data-item-number">{{$data['letting']->TotalRooms}}</div>
                    </div>
                    <div class="l-house-data-item">
                        <div class="l-house-data-item-icon-car"></div>
                        <div class="l-house-data-item-number">{{$data['letting']->TotalGarages}}</div>
                    </div>
                </div>
            </div>
            <!--<div class="l-house-summary no-padding">
                <div class="l-house-summary-group-items">
                    <div class="button-square-white"><span>central location</span></div>
                    <div class="button-square-white"><span>deceptivly spacious</span></div>
                    <div class="button-square-white"><span>separate bathroom</span></div>
                    <div class="button-square-white"><span>separate bathroom</span></div>
                </div>
            </div>-->
        </div>
        <article class="hidden-md hidden-lg">
            <p class="no-margin">
                {{$data['letting']->Description}}
            </p>
        </article>
        <div class="l-aside-property-view-map"></div>
        <div class="l-aside-property-view-buttons">
            <div>
                <a href="" data-toggle="modal" data-target="#arrangeview-modal">
                    <div class="button-rounded-red-view">
                        <span class="glyphicon glyphicon-eye-open"></span><span>ARRANGE VIEWING</span>
                    </div>
                </a>
                <a href="" data-toggle="modal" data-target="#fees-modal">
                    <div class="button-rounded-red-view">
                        <span class="glyphicon glyphicon-gbp"></span><span>FEES APPLY</span>
                    </div>
                </a>		
            </div>
            <div>
                <a data-toggle="modal" data-target="#epcreport-modal">
                    <div class="button-rounded-red-view" id="epc-report" data-value="{{$data['letting']->PropertyId}}">
                        <span class="glyphicon glyphicon-refresh"></span><span>EPC REPORT</span>
                    </div>
                </a>
                <a href="{{action('Web\LettingController@GetBrochure', ['id' => $data['letting']->PropertyId])}}">
                    <div class="button-rounded-red-view">
                        <span class="glyphicon glyphicon-print"></span><span>PRINT</span>
                    </div>
                </a>		
            </div>
        </div>
    </aside>
</div>

<!--END PROPERTY VIEW-->
<script>letting.SetUp();</script>
@endsection