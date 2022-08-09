<?php

use App\Client;
use App\Company;
use App\Models\General;
use App\Social;
use App\User;


function get_lang(){
    return app()->getLocale();

}
function get_general_value($key)
{
    $general = General::where('key', $key)->first();
    if ($general) {
        return $general->value;
    }

    return '';
}
function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}




