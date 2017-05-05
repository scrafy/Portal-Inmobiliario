<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Tenantsystemtype extends BaseModel {

    protected $table = 'tenantsystemtypes';
    protected $primarykey = 'id';
    protected $fillable = ['Name'];

    public function getLettings() {
        return $this->belongsToMany('App\Models\ExternalApi\Letting');
    }

}
