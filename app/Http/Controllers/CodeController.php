<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Famous;
use App\Models\Stores;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Admin')){
            $codes = Code::orderBy('id','desc')->get();
        }else{
          
            $codes = Code::where('famous_id',  auth()->user()->famous->id)->orderBy('id','desc')->get();
        }
        return view('dashboard.codes.index')->with('codes',$codes)->with('famous',Famous::get())->with('stores',Stores::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Code();
        $country->code =$request->code;
        $country->store_id =$request->store_id;
        $country->famous_id =$request->famous_id;
        $country->discount_percentage =str_replace('%','',$request->discount_percentage);
        $country->benefit_percentage = str_replace('%','',$request->benefit_percentage);
        $country->system_percentage =str_replace('%','',$request->system_percentage);
        $country->famous_percentage = str_replace('%','',$request->famous_percentage);
        $country->start_at = $request->start_at;
        $country->end_at = $request->end_at;
        $country->user_id = auth()->id();
        $country->save();
        $count = Code::count() ;
        return view('dashboard.codes._code')->with('item',$country)->with('key',$count);
    }
    public function get_form_code(Request $request)
    {
        $store = Code::find($request->id);
        return view('dashboard.codes.edit')->with('code',$store)->with('famous',Famous::get())->with('stores',Stores::get());
    }
    public function check_code(Request $request){
        $store = Stores::find($request->store);
        $api = $store->api_link."?code=".$request->code;
    try{                
        $response =  Http::get($api);
        if($response->json()['status']['HTTP_code'] == 400){
            return response()->json(['status'=>'false','message'=>"هذا الكود خاطيء"]);
        }else{
            $code = $response->json()['data']['discount'];
            $start_at = date('Y-m-d', strtotime($response->json()['data']['start_date']));
            $end_at = date('Y-m-d', strtotime($response->json()['data']['end_date']));

            return response()->json(['status'=>'true','discount'=>$code,'start_at'=>$start_at,'end_at'=>$end_at,'message'=>"تم التحقق من الكود "]);

        }

    }
    catch(\Exception $e) {
        return response()->json(['status'=>'false','message'=>"هناك خطأ بالربط الخاص بالمتجر"]);

    }
    
       
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update_code(Request $request)
    {
        $country = Code::find($request->id);
        $country->code =$request->code;
        $country->store_id =$request->store_id;
        $country->famous_id =$request->famous_id;
        $country->discount_percentage =str_replace('%','',$request->discount_percentage);
        $country->benefit_percentage = str_replace('%','',$request->benefit_percentage);
        $country->system_percentage =str_replace('%','',$request->system_percentage);
        $country->famous_percentage = str_replace('%','',$request->famous_percentage);
        $country->start_at = $request->start_at;
        $country->end_at = $request->end_at;
        $country->save();
        return $country;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = Code::find($id);
        $code->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
