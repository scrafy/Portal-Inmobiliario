<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;

/*
  {
  "preferredDate":"01/01/20176",
  "propertyIDsToView":["asdasd","asdasd","asdasd","asdasd"]
  }
 */

class ViewBookModel extends BaseModel {

    public $preferredDate;
    public $propertyIDsToView;
    protected $validation_rules = [
        'preferredDate' => 'date',
        'propertyIDsToView' => 'array'
    ];

}
