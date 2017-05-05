<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class PostCode extends BaseModel {

    protected $table = 'postcodes';

    public function getProperties() {
        return $this->hasMany('App\Models\ExternalApi\Property', 'PostCode', 'PostCode');
    }

}
