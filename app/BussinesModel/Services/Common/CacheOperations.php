<?php

namespace App\BussinesModel\Services\Common;

use App\BussinesModel\Interfaces\Common\ICacheOperations;

class CacheOperations implements ICacheOperations {

    private $minutes;

    public function __construct() {

        $this->minutes = config("myparametersconfig.cache_minutes");
    }

    public function ClearCache() {

        \Cache::flush();
    }

    public function RemoveItem($key) {

        \Cache::forget($key);
    }

    public function StoreForever($key, $value) {
        \Cache::forever($key, $value);
    }

    public function StoreIfNoPresent($key, $value) {
        \Cache::add($key, $value, $this->minutes);
    }

    public function getValue($key) {

        if (\Cache::has($key)) {
            return \Cache::get($key);
        }
        return null;
    }

    public function hasKey($key) {

        if (\Cache::has($key)) {
            return true;
        }
        return false;
    }

    public function setValue($key, $value) {

        \Cache::put($key, $value, $this->minutes);
    }

    public function setValueIfNotExists($key, $value) {

        \Cache::add($key, $value, $this->minutes);
    }

    public function RetrieveAndStore($key, $value) {

        return \Cache::remember($key, $this->minutes, function () use ($value) {
                    return $value;
                });
    }

}
