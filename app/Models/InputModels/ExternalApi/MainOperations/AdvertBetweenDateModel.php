<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;

/*
  {
  "areaID":"",
  "rentMinimum":"",
  "rentMaximum":"",
  "maximumTenants":"",
  "wantSharedProperties":"",
  "wantStudentProperties":"",
  "branchID":"0004-f421-2742-3f00",
  "rangeStartDate":"2017-03-20T00:00:00",
  "rangeEndDate":"2017-04-08T00:00:00"
  }
 */

class AdvertBetweenDateModel extends BaseModel {

    public $areaID;
    public $rentMinimum;
    public $rentMaximum;
    public $maximumTenants;
    public $wantSharedProperties;
    public $wantStudentProperties;
    public $branchID;
    public $rangeStartDate;
    public $rangeEndDate;
    protected $validation_rules = [
        'rentMinimum' => 'numeric | nullable',
        'rentMaximum' => 'numeric | nullable',
        'maximumTenants' => 'integer | nullable',
        'wantSharedProperties' => 'boolean | nullable',
        'wantStudentProperties' => 'boolean | nullable',
        'branchID' => 'required',
        'rangeStartDate' => 'date',
        'rangeEndDate' => 'date'
    ];

}
