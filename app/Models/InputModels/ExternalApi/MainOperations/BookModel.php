<?php

namespace App\Models\InputModels\ExternalApi\MainOperations;

use App\Models\BaseModel;
use App\Models\InputModels\ExternalApi\MainOperations\BookSlotModel;

/*
  {
  "forename":"",
  "surname":"",
  "mobilePhone":"",
  "emailAddress":"",
  "propertyIDsToView":["asdasd","asdasd","asdasd","asdasd"],
  "selectedViewingSlot":{
  "preferredDate":"01/01/20176",
  "propertyIDsToView":["asdasd","asdasd","asdasd","asdasd"]
  },
  "wantRoomInSharedProperty":"",
  "alertMinRent":"",
  "alertMaxRent":"",
  "alertNumberOfBeds":"",
  "alertAreaID":"",
  "alertTenantType":"",
  "subscribeToEmailAlerts":"",
  "subscribeToSMSAlerts":""
  }
 */

class BookModel extends BaseModel {

    public $forename;
    public $surname;
    public $mobilePhone;
    public $emailAddress;
    public $propertyIDsToView;

    /**
     * @var BookSlotModel
     */
    public $selectedViewingSlot;
    public $wantRoomInSharedProperty;
    public $alertMinRent;
    public $alertMaxRent;
    public $alertNumberOfBeds;
    public $alertAreaID;
    public $alertTenantType;
    public $subscribeToEmailAlerts;
    public $subscribeToSMSAlerts;
    protected $validation_rules = [
        'forename' => 'required',
        'surname' => 'required',
        'mobilePhone' => 'required',
        'emailAddress' => 'email',
        'propertyIDsToView' => 'array',
        'wantRoomInSharedProperty' => 'boolean | nullable',
        'alertMinRent' => 'numeric | nullable',
        'alertMaxRent' => 'numeric | nullable',
        'alertNumberOfBeds' => 'integer | nullable',
        'subscribeToEmailAlerts' => 'boolean | nullable',
        'subscribeToSMSAlerts' => 'boolean | nullable'
    ];

}
