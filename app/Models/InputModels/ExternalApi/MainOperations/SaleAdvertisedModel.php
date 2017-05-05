<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;

/*
  {
  "onlyDevelopement":false,
  "onlyInvestements":false,
  "minimumPrice":"",
  "maximumPrice":"",
  "minimumBeds":"",
  "minimumBathrooms":"",
  "minimumEnsuites":"",
  "minimumToilets":"",
  "minimumReception":"",
  "branchID":"0004-f421-2742-3f00"
  }
 */

class SaleAdvertisedModel extends BaseModel {

    public $onlyDevelopement;
    public $onlyInvestements;
    public $minimumPrice;
    public $maximumPrice;
    public $minimumBeds;
    public $minimumBathrooms;
    public $minimumEnsuites;
    public $minimumToilets;
    public $minimumReception;
    public $branchID;
    protected $validation_rules = [
        'onlyDevelopement' => 'boolean',
        'onlyInvestements' => 'boolean',
        'minimumPrice' => 'numeric | nullable',
        'maximumPrice' => 'numeric | nullable',
        'minimumBeds' => 'integer | nullable',
        'minimumBathrooms' => 'integer | nullable',
        'minimumEnsuites' => 'integer | nullable',
        'minimumToilets' => 'integer | nullable',
        'minimumReception' => 'integer | nullable',
        'branchID' => 'required'
    ];

}
