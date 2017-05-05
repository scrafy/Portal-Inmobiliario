<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class PostCodeArea extends BaseModel {

    protected $table = 'postcode_areas';
    protected $fillable = ['area', 'postcode_area'];

    public function getProperties() {
        return $this->hasMany('App\Models\ExternalApi\Property', 'PostCodeArea', 'postcode_area');
    }

}
