<?php

namespace App\BussinesModel\Interfaces\Common;

interface ICacheOperations {

    public function setValue($key, $value);

    public function getValue($key);
    
    public function hasKey($key);
    
    public function StoreForever($key, $value);
    
    public function StoreIfNoPresent($key, $value);
    
    public function ClearCache();
    
    public function RemoveItem($key);
    
    public function SetValueIfNotExists($key, $value);
    
    public function RetrieveAndStore($key, $value);
}
