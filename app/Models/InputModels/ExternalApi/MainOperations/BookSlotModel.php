<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;

/*
  {
  "preferredDate":"01/01/20176",
  "propertyIDsToView":["asdasd","asdasd","asdasd","asdasd"]
  }
 */

class BookSlotModel extends BaseModel {

    public $Start;
    public $End;
    public $StaffName;
    public $StaffID;
    protected $validation_rules = [
        'Start' => 'date',
        'End' => 'date',
        'StaffName' => 'required',
        'StaffID' => 'required'
    ];

}
