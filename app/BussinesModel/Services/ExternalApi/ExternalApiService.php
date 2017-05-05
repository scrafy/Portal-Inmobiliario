<?php

namespace App\BussinesModel\Services\ExternalApi;

abstract class ExternalApiService {

    protected $api_key;
    protected $tier;
    protected $shortname;
    protected $endpoint;

    public function __construct() {
        $this->api_key = config('externalservice.api_key');
        $this->shortname = config('externalservice.shortname');
        $this->tier = config('externalservice.tier');
        $this->endpoint = config('externalservice.endpoint');
    }

    public function __get($name) {
        return $this->$name;
    }

    public function makeCall($url, $body = null, $is_image = false) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (($body != null)) {

            $data_string = json_encode($body);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json', 'Content-Length: ' . strlen($data_string)]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        }
        $resp = curl_exec($ch);
        curl_close($ch);
        if (!$is_image) {
            return json_decode($resp);
        }
        return $resp;
    }

}
