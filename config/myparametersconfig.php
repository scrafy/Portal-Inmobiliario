<?php

return [
    /* Path for property images */
    'pathimgproperty' => env('PATH_IMG_PROPERTY','/app/public/img/Properties/'),
    /* Path for property brochures */
    'pathimgbrochures' => env('PATH_IMG_BROCHURES','/app/public/img/Properties/Brochures/'),
    /* Path for property epcreports */
    'pathimgepc' => env('PATH_IMG_EPC','/app/public/img/Properties/EpcReports/'),
    /* Pagination values */
    'records_x_page' => env('RECORDS_X_PAGE', 2),
    'limit_pages_to_show' => env('LIMITS_PAGE_TO_SHOW', 5),
    /* Min and Max price for filter menu */
    'minprice' => env('MIN_PRICE', 0),
    'maxprice' => env('MAX_PRICE', 5000),
    /* path for input models */
    'input_models_path' => 'App\Models\InputModels',
    'google_api_key' => env('GOOGLE_API_KEY','')
];
