<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Letting extends BaseModel {

    protected $table = 'lettings';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id', 'Etag', 'GlobalReference', 'IsTenancyAdvertised', 'IsTenancyProposed', 'TermStart', 'Area',
        'RentAdvertised', 'RentSchedule', 'RentRecurrence', 'AdvertiseFrom', 'BondRequired',
        'Furnished', 'IsShareProperty', 'IsStudentProperty', 'MinimumTenants', 'MaximumTenants',
        'TermMinimum', 'TermMaximum', 'PropertyId', 'BranchId'
    ];

    public function getProperty() {
        return $this->belongsTo('App\Models\ExternalApi\Property', 'PropertyId', 'id');
    }

    public function getBranch() {
        return $this->belongsTo('App\Models\ExternalApi\Branch', 'BranchId', 'id');
    }

    public function getTenantSystemTypes() {
        return $this->belongsToMany('App\Models\ExternalApi\Tenantsystemtype');
    }

    public function getAppointments() {
        return $this->hasMany('App\Models\InputModels\Web\Letting\Appointment', 'LettingId', 'id');
    }

}
