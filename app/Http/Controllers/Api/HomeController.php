<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CopounResource;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function check(Request $request){
        if($request->code == null){
            return $this->SendError('code is empty');
        }
        $code = Coupon::where('code',$request->code)->where('status',1)->first();
        if($code){
            if($code->start_at <= Carbon::now()->format('Y-m-d') && $code->end_at >= Carbon::now()->format('Y-m-d') ){
                if($code->is_is_unlimit == 1){
                    $coderes =new CopounResource($code);

                    return $this->sendResponse($coderes,'You can use this code');
                }else{
                    $count = $code ->use_count;
                    if($count <$code->num_use){
                        $coderes =new CopounResource($coderes);

                        return $this->sendResponse($code,'You can use this code');
                    }else{
                        return $this->SendError('The maximum usage of this coupon has been reached');  
                    }
                }
            }else{
                return 'false';
            }
        }else{
            return $this->SendError('Copoun Not Found');  
        }
    }
    public function use_code(Request $request){

        if($request->code == null){
            return $this->SendError('code is empty');
        }
        $code = Coupon::where('code',$request->code)->where('status',1)->first();
        if($code){
            if($code->start_at <= Carbon::now()->format('Y-m-d') && $code->end_at >= Carbon::now()->format('Y-m-d') ){
                if($code->is_is_unlimit == 1){
                  $code = Coupon::where('code',$request->code)->where('status',1)->first();
                    $code ->use_count += 1;
                    $code->save();
                    $coderes =new CopounResource($code);
                    return $this->sendResponse($code,'Successfully used');
                }else{
                    $count = $code ->use_count;
                    if($count <$code->num_use){
                        $code = Coupon::where('code',$request->code)->where('status',1)->first();
                        $code ->use_count += 1;
                        $code->save();
                        $coderes =new CopounResource($code);
                        return $this->sendResponse($coderes,'Successfully used');
                    }else{
                        return $this->SendError('The maximum usage of this coupon has been reached');  
                    }
                }
            }else{
                return $this->SendError('Copoun Not Found');  
            }
        }else{
            return $this->SendError('Copoun Not Found');  
        }
    
    }
    public function get_all(){
        $coderes = CopounResource::collection(Coupon::get());
        return $this->sendResponse($coderes,'Successfully used');

    }
}
