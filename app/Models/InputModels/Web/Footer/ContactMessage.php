<?php

namespace App\Models\InputModels\Web\Footer;

use App\Models\BaseModel;

class ContactMessage extends BaseModel {

    public $Name;
    public $Email;
    public $Phone;
    public $Subject;
    public $Message;
    protected $validation_rules = [
        'Name' => 'required',
        'Email' => 'email',
        'Phone' => 'required',
        'Message' => 'required',
        'Subject' => 'required'
    ];

}
