<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;

/*
  {
  "areaID":"0900-b401-ac99-8780",
  "rentMinimum":"",
  "rentMaximum":"",
  "maximumTenants":"",
  "wantSharedProperties":"",
  "wantStudentProperties":"",
  "branchID":"0004-f421-2742-3f00"
  }
 */

class AdvertModel extends BaseModel {

    public $areaID;
    public $rentMinimum;
    public $rentMaximum;
    public $maximumTenants;
    public $wantSharedProperties;
    public $wantStudentProperties;
    public $branchID;
    protected $validation_rules = [
        'rentMinimum' => 'numeric | nullable',
        'rentMaximum' => 'numeric | nullable',
        'maximumTenants' => 'integer | nullable',
        'wantSharedProperties' => 'boolean | nullable',
        'wantStudentProperties' => 'boolean | nullable',
        'branchID' => 'required'
    ];

}
