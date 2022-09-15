<?php

namespace App\Http\Controllers;

use App\Models\AddIncome;
use App\Models\AddTotal;
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
    public function get_form_total(Request $request){
        $id = $request->id;
        return view('dashboard.codes.add_total')->with('code',$id);
    }
    
    public function get_form_income(Request $request){
        $id = $request->id;
        return view('dashboard.codes.add_income')->with('code',$id);
    }
    public function store_income(Request $request){
        $store = new AddIncome();
        $store->amount = $request->amount;
        $store->code_id = $request->code_id;
        $store->save();
        return true;
    }
    public function store_total(Request $request){
        $store = new AddTotal();
        $store->amount = $request->amount;
        $store->code_id = $request->code_id;
        $store->save();
        return true;
    }
    public function history_for_income(){
        $codes = AddIncome::orderBy('id','desc')->get();
        return view('dashboard.codes.total_income')->with('codes',$codes);
    }
    public function history_for_total(){
        $codes = AddTotal::orderBy('id','desc')->get();
        return view('dashboard.codes.total_income')->with('codes',$codes);
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
        $exsitst = Code::where('famous_id',$request->famous_id)->where('code',$request->code)->where('store_id',$request->store_id)->first();
        if($exsitst){
            return response()->json(['message'=>"هذا الكود مستخدم من قبل"], 500);

        }

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
            $beneif = $store->benift;
            $total =$response->json()['data']['total_amount_use'];
            $benift_new = ($store->benift *$total)/100;



            return response()->json(['status'=>'true','beneif'=>$beneif,'benift_new'=>$benift_new,'discount'=>$code,'start_at'=>$start_at,'end_at'=>$end_at,'message'=>"تم التحقق من الكود "]);

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
        $exsitst = Code::where('famous_id',$request->famous_id)->where('code',$request->code)->where('store_id',$request->store_id)->first();
        if($exsitst){
            return response()->json(['message'=>"هذا الكود مستخدم من قبل"], 500);

        }
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
    public function wallet_transfare(Request $request)
    {
        $code = Code::find($request->id);
        $total = $code->total_famous - ($code->total_trans + $code->total_pending);
        if($total >= get_general_value('min_wallet') ){
            $error = 'success';
        }else{
            $error = 'error';
  
        }

        return view('dashboard.wallet.transfer')->with('code',$code)->with('total',$total)->with('error',$error);
    }
    public  function get_wallet_order(Request $request) 
    {
        $code = Code::find($request->id);
        $store = $code->store->title;
        $famous = $code->famous->name;

        $api = $code->store->api_link."?code=".$code->code;
    try{                
        $response =  Http::get($api);
        if($response->json()['status']['HTTP_code'] == 400){
            $orders = null;
            return view('dashboard.wallet.orders')->with('orders',$orders)->with('code',$code)->with('store',$store)->with('famous',$famous);
        }else{
            $orders = $response->json()['data']['orders'];
            $array = array();
            foreach($orders as $or){
                array_push($array,$or);
            }
            return view('dashboard.wallet.orders')->with('orders',$array)->with('code',$code)->with('store',$store)->with('famous',$famous);


            

        }

    }
    catch(\Exception $e) {
        return view('dashboard.wallet.orders')->with('orders',null)->with('code',$code)->with('store',$store)->with('famous',$famous);

    }
    }
    public function destroy($id)
    {
        $code = Code::find($id);
        $code->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
