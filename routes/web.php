<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::group(['namespace' => 'Web'], function () {

    /* HomeController */

    Route::get('/', 'HomeController@Home');
    Route::get('/landlords', 'HomeController@Landlords');
    Route::get('/information', 'HomeController@Information');
    Route::get('/aboutus', 'HomeController@Aboutus');
    Route::get('/news', 'HomeController@News');

    /* LettingController */

    Route::get('/viewproperty/{id}', 'LettingController@View');
    Route::get('/getepcreport/{id}', 'LettingController@GetEpcReport');
    Route::get('/getbrochure/{id}', 'LettingController@GetBrochure');
    Route::get('/filter', 'LettingController@FilterLettings');
    Route::get('/getmapinformation/{postcode?}', 'LettingController@GetMapInformation');
    Route::get('/getlatlngfrompostcode/{postcode}', 'LettingController@GetLatLongFromPostCode');
    Route::post('/appointment', 'LettingController@CreateAppointment')->middleware("binding:Appointment," . config('myparametersconfig.input_models_path') . "\Web\Letting");
    Route::post('/sendmessagecontact', 'FooterController@SendContactMessage')->middleware("binding:ContactMessage," . config('myparametersconfig.input_models_path') . "\Web\Footer");
});




//EXTERNAL_API_ROUTES

Route::group(['prefix' => 'extapi', 'namespace' => 'ExternalApi'], function () {

    Route::get('/getareas', 'AreaController@getAreas');
    Route::get('/getarea/{areaid}', 'AreaController@getAreaById');

    Route::get('/getbranches', 'BranchController@getBranches');
    Route::get('/getbranch/{branchid}', 'BranchController@getBranchById');

    Route::get('/getcounties', 'CountyController@getCounties');
    Route::get('/getcounty/{countyid}', 'CountyController@getCountyById');
    Route::get('/getcountybranches/{countyid}', 'CountyController@getCountyBranches');

    Route::get('/getallocations', 'DiaryController@getAllocations');
    Route::get('/getallocation/{allocationid}', 'DiaryController@getAllocationById');
    Route::get('/getappointments', 'DiaryController@getAppointments');
    Route::get('/getappointment/{appointmentid}', 'DiaryController@getAppointmentById');
    Route::get('/getappointmenttypes', 'DiaryController@getAppointmentTypes');
    Route::get('/getappointmenttype/{appointmentid}', 'DiaryController@getAppointmentTypeById');

    Route::post('/getlettings', 'LettingsController@getLettings')->middleware("binding:AdvertModel," . config('externalservice.input_models_path'));
    Route::post('/getlettingsbetweendates', 'LettingsController@getLettingsBetweenDates')->middleware("binding:AdvertBetweenDateModel," . config('externalservice.input_models_path'));
    Route::get('/gettenancies', 'LettingsController@getTenancies');
    Route::get('/gettenancy/{tenancyid}', 'LettingsController@getTenancyById');
    Route::get('/getbrochure/{tenancyid}', 'LettingsController@getBrochure');

    Route::get('/getphotos', 'PhotoController@getPhotos');
    Route::get('/getphoto/{photoid}', 'PhotoController@getPhotoById');
    Route::get('/downloadphoto/{photoid}', 'PhotoController@DownLoad');

    Route::get('/getproperties', 'PropertyController@getProperties');
    Route::get('/getproperty/{propertyid}', 'PropertyController@getPropertyById');
    Route::get('/getfacilities/{propertyid}', 'PropertyController@getFacilities');
    Route::get('/getpropertyphotos/{propertyid}', 'PropertyController@getPhotos');
    Route::get('/getrooms/{propertyid}', 'PropertyController@getRooms');
    Route::get('/getpropertyenergyreport/{propertyid}', 'PropertyController@getEnergyReport');
    Route::get('/getpropertyenvironmentalreport/{propertyid}', 'PropertyController@getEnvironmentalReport');

    Route::post('/getsales', 'SalesController@getAdvertisedSales')->middleware("binding:SaleAdvertisedModel," . config('externalservice.input_models_path'));
    Route::get('/getsaleenergyreport/{instructionid}', 'SalesController@getEnergyReport');
    Route::get('/getsaleenvironmentalreport/{instructionid}', 'SalesController@getEnvironmentalReport');
    Route::get('/getsalefeaturetypes', 'SalesController@getSalesFeatureTypes');
    Route::get('/getsalefeaturetype/{featureid}', 'SalesController@getSalesFeatureType');
    Route::get('/getsaleinstructions', 'SalesController@getSalesInstructions');
    Route::get('/getsaleinstruction/{instructionid}', 'SalesController@getSalesInstruction');
    Route::get('/getsalefeatures/{instructionid}', 'SalesController@getSalesInstructionsFeatures');
    Route::get('/getsalephotos/{instructionid}', 'SalesController@getSalesInstructionsPhotos');
    Route::get('/getsalerooms/{instructionid}', 'SalesController@getSalesInstructionsRooms');
    Route::get('/getsalefloorplans/{instructionid}', 'SalesController@getSalesInstructionsFloorPlans');

    Route::get('/getstafflist', 'StaffController@getStaffs');
    Route::get('/getstaff/{staffid}', 'StaffController@getStaffById');

    Route::post('/getbooks', 'BookController@getBooks')->middleware("binding:ViewBookModel," . config('externalservice.input_models_path'));
    Route::post('/getbook', 'BookController@getBook')->middleware("binding:SaleAdvertisedModel," . config('externalservice.input_models_path'));

    Route::get('/updatedb', 'UpdateDBController@UpdateDB');
    Route::get('/downloadphotos', 'UpdateDBController@DownLoadPhotos');
});




