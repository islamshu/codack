<?php

use App\Client;
use App\Company;
use App\Models\Code;
use App\Models\General;
use App\Social;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

function get_account_status($stauts){
    if($stauts == 0){
        return 'مرفوض';
    }elseif($stauts == 1){
        return 'مقبول';

    }elseif($stauts == 2){
        return 'معلق ';

    }
}
function get_total_code($id){
    $code = Code::find($id);
    $api = $code->store->api_link."?code=".$code->code;
    $response = Http::get($api);
    if($response->json()['status']['HTTP_code'] == 400){
        return '_';
    }
    $data = $response->json()['data'];
    $count = $data['count'];
    return $count;

}
function get_total_mount_code($id){
    $code = Code::find($id);
    $api = $code->store->api_link."?code=".$code->code;
    $response = Http::get($api);
    if($response->json()['status']['HTTP_code'] == 400){
        return '_';
    }
    $data = $response->json()['data'];
    $total = $data['total_amount_use'];
    return $total;
}

function get_total_system_code_api($id){
    $code = Code::find($id);
    $api = $code->store->api_link."?code=".$code->code;
    $response = Http::get($api);
    if($response->json()['status']['HTTP_code'] == 400){
        return '_';
    }
    $data = $response->json()['data'];
    $total =get_total_benefit($id);;

    return ($total*$code->system_percentage)/100;
}
function get_total_benefit($id){
    $code = Code::find($id);
    $api = $code->store->api_link."?code=".$code->code;
    $response = Http::get($api);
    if($response->json()['status']['HTTP_code'] == 400){
        return '_';
    }

    $data = $response->json()['data'];
    $code->total = $data['total_amount_use'];
    $code->start_at = date('Y-m-d', strtotime($data['start_date']));
    $code->end_at   =   date('Y-m-d', strtotime($data['end_date']));
    $total = $data['total_amount_use'];
    $code->benefit_percentage = $code->store->benift;
    $benift = ($code->store->benift *$total)/100;

    $code->save();

    return $benift;
}
function get_total_famous_code_api($id){
    $code = Code::find($id);
    $api = $code->store->api_link."?code=".$code->code;
    $response = Http::get($api);
    if($response->json()['status']['HTTP_code'] == 400){
        return '_';
    }

    $data = $response->json()['data'];
    $code->total = $data['total_amount_use'];
    $code->start_at = date('Y-m-d', strtotime($data['start_date']));
    $code->end_at   =   date('Y-m-d', strtotime($data['end_date']));
    $total = get_total_benefit($id);

    
    $code->benefit_percentage = $code->store->benift;
    $code->total_famous = ($total*$code->famous_percentage)/100;
    $code->total_system = ($total*$code->system_percentage)/100;
    $code->save();

    return ($total*$code->famous_percentage)/100;
}

function active_code_count(){
    $code = Code::where('start_at' ,'<=', Carbon::now()->format('Y-m-d'))->where('end_at' ,'>=', Carbon::now()->format('Y-m-d'))->count();
    return $code;
}
function deactive_code_count(){
    $code = Code::where('start_at' ,'<=', Carbon::now()->format('Y-m-d'))->where('end_at' ,'>=', Carbon::now()->format('Y-m-d'))->count();
   $total = Code::count();
    return $total- $code;
}
function get_account_status_color($stauts){
    if($stauts == 0){
        return 'danger';
    }elseif($stauts == 1){
        return 'success';

    }elseif($stauts == 2){
        return 'warning';

    }
}
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




