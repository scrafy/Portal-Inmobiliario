<?php
namespace App\Facades\FacadesImplementation;

class Strings
{
    
    public function SplitCapitalizeString($input)
    {
        return preg_replace("([A-Z])", " $0", $input);
    }
    
    public function EnDateForNoTime($date)
    {
        return date("d-m-Y", strtotime($date));
    }
    
    public function StrToLower($input)
    {
        return strtolower($input);
    }
    
    public function PropertyName($input)
    {
        return strtolower(str_replace(" ","",$input));
    }
    
}