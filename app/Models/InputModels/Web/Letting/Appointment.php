<?php

namespace App\Models\InputModels\Web\Letting;

use App\Models\BaseModel;

class Appointment extends BaseModel {

    protected $table = 'appointments';
    protected $fillable = [
        'FirstName', 'LastName', 'Email', 'Mobile', 'Message', 'ContactBy', 'FirstDate', 'SecondDate', 'ThirdDate',
        'LettingId'
    ];

    /**
     * @forinsert
     */
    public $FirstName;

    /**
     * @forinsert
     */
    public $LastName;

    /**
     * @forinsert
     */
    public $Email;

    /**
     * @forinsert
     */
    public $Mobile;

    /**
     * @forinsert
     */
    public $Message;

    /**
     * @forinsert
     */
    public $ContactBy;

    /**
     * @forinsert
     */
    public $FirstDate;

    /**
     * @forinsert
     */
    public $SecondDate;

    /**
     * @forinsert
     */
    public $ThirdDate;

    /**
     * @forinsert
     */
    public $LettingId;
    protected $validation_rules = [
        'FirstName' => 'required',
        'LastName' => 'required',
        'Email' => 'email',
        'Mobile' => 'required',
        'Message' => 'required',
        'ContactBy' => 'in:n/a,email,phone',
        'FirstDate' => 'date_format:Y-m-d H:i:s',
        'LettingId' => 'required'
    ];

    public function getLetting() {
        return $this->belongsTo('App\Models\ExternalApi\Letting', 'LettingId', 'id');
    }

}
