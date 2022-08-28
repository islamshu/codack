<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CouponController extends Controller
{
    public function index(){
        return view('dashboard.coupon.index')->with('coupons',Coupon::orderby('id','desc')->get());
    }
    public function store(Request $request){
      $coupon = new Coupon();
      if($request->code_typing == 1){
        $coupon->code = $request->code;
      }else{
        $coupon->code = Str::random(5);
      }
      $coupon->discount = $request->discount;
      $coupon->type = $request->type;
      $coupon->is_unlimit = $request->is_unlimit;
      $coupon->num_use = $request->num_use;
      $coupon->start_at = $request->start_at;
      $coupon->end_at = $request->end_at;
      $coupon->use_count = 0;
      $coupon->status =1;
      $coupon->save();
      $count = Coupon::count();
      return view('dashboard.coupon._coupon')->with('item', $coupon)->with('key', $count);
    }
    public function updateStatus(Request $request)
{
    $coupon = Coupon::findOrFail($request->copoun_id);
    $coupon->status = $request->status;
    $coupon->save();

    return response()->json(['message' => 'Coupon status updated successfully.']);
}
public function update_copoun(Request $request,$id){
    $coupon = Coupon::find($id);
    $coupon->discount = $request->discount;
    $coupon->type = $request->type;
      $coupon->is_unlimit = $request->is_unlimit;
      $coupon->num_use = $request->num_use;
      $coupon->start_at = $request->start_at;
      $coupon->end_at = $request->end_at;
      $coupon->save();
      return $coupon;
}
public function get_form_copoun(Request $request)
{
    $store = Coupon::find($request->id);
    return view('dashboard.coupon.edit')->with('copoun',$store);

}
public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }
    
}
