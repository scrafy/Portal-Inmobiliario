<?php

return [
    'input_models_path' => 'App\Models\InputModels\ExternalApi\MainOperations',
    'api_key' => 'JdRjeFJeihSNG50C06LY6K6GE3o5Sn4Bo77LdkKjY8c1',
    'shortname' => 'letmcletting',
    'endpoint' => 'https://live-api.letmc.com',
    'num_max_records' => 100,
    'tier' => 'tier1',
    'external_api_links' => [
        'main_operations' => [
            'property' => [
                'getproperties' => '/v2/%s/%s/property/properties',
                'getproperty' => '/v2/%s/%s/property/properties/%s',
                'getrooms' => '/v2/%s/%s/property/properties/%s/rooms',
                'getenergyefficiencyreport' => '/v2/%s/%s/property/structures/%s/reports/eer',
                'getenvironmentalreport' => '/v2/%s/%s/property/structures/%s/reports/eir',
                'getphotos' => '/v2/%s/%s/property/properties/%s/photos',
                'getfacilities' => '/v2/%s/%s/property/properties/%s/facilities'
            ],
            'area' => [
                'getareas' => '/v2/%s/%s/area/areas',
                'getarea' => '/v2/%s/%s/area/areas/%s'
            ],
            'branch' => [
                'getbranches' => '/v2/%s/%s/branch/branches',
                'getbranch' => '/v2/%s/%s/branch/branches/%s'
            ],
            'county' => [
                'getcounties' => '/v2/%s/%s/county/counties',
                'getcounty' => '/v2/%s/%s/county/counties/%s',
                'getcountybranches' => '/v2/%s/%s/county/counties/%s/branches'
            ],
            'diary' => [
                'getallocations' => '/v2/%s/%s/diary/allocations',
                'getallocation' => '/v2/%s/%s/diary/allocations/%s',
                'getappointments' => '/v2/%s/%s/diary/appointments',
                'getappointment' => '/v2/%s/%s/diary/appointments/%s',
                'getappointmenttypes' => '/v2/%s/%s/diary/appointmenttypes',
                'getappointmenttype' => '/v2/%s/%s/diary/appointmenttypes/%s'
            ],
            'letting' => [
                'getlettings' => '/v2/%s/%s/lettings/advertised',
                'getlettingsdates' => '/v2/%s/%s/lettings/advertisedbetweendates',
                'getbrochure' => '/v2/%s/%s/lettings/tenancies/%s/brochure',
                'gettenancy' => '/v2/%s/%s/lettings/tenancies/%s',
                'gettenancies' => '/v2/%s/%s/lettings/tenancies',
            ],
            'photo' => [
                'getphoto' => '/v2/%s/%s/photo/photos/%s',
                'getphotos' => '/v2/%s/%s/photo/photos',
                'download' => '/v2/%s/%s/photos/photo/%s/download'
            ],
            'sales' => [
                'getsales' => '/v2/%s/%s/sales/advertisedsales',
                'getenergyefficiencyreport' => '/v2/%s/%s/sales/reports/eer/%s',
                'getenvironmentalreport' => '/v2/%s/%s/sales/reports/eir/%s',
                'getsalesfeaturetypes' => '/v2/%s/%s/sales/salesfeaturetypes',
                'getsalesfeaturetype' => '/v2/%s/%s/sales/salesfeaturetypes/%s',
                'getsalesintructions' => '/v2/%s/%s/sales/salesinstructions',
                'getsaleinstruction' => '/v2/%s/%s/sales/salesinstructions/%s',
                'getsalesinstructionsfeatures' => '/v2/%s/%s/sales/salesinstructions/%s/features',
                'foorplans' => '/v2/%s/%s/sales/salesinstructions/%s/floorplans',
                'photos' => '/v2/%s/%s/sales/salesinstructions/%s/photos',
                'rooms' => '/v2/%s/%s/sales/salesinstructions/%s/rooms',
            ],
            'staff' => [
                'getstaffmembers' => '/v2/%s/%s/staff/staff',
                'getstaffmember' => '/v2/%s/%s/staff/staff/%s'
            ],
            'book' => [
                'getbookings' => '/v2/%s/%s/viewing/bookings',
                'getbooking' => '/v2/%s/%s/viewing/bookings'
            ]
        ],
    ],
];
