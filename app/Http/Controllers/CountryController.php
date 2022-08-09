<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.country.index')->with('country',Country::orderby('id','desc')->get());
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'flag'=>'required',
            'code'=>'required',

        ]);
        $country = new Country();
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $country->flag = $request->flag->store('country');
        $country->code = $request->code;
        $country->save();
        $count = Country::count() ;
        return view('dashboard.country._country')->with('country',$country)->with('key',$count);
    }
    public function store_country_for_famous(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'flag'=>'required',
            'code'=>'required',

        ]);
        $country = new Country();
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $country->flag = $request->flag->store('country');
        $country->code = $request->code;
        $country->save();
        $count = Country::count() ;
        if(get_lang()=='ar'){
            $title = $request->title_ar;
        }else{
            $title = $request->title_en;
        }
        return response()->json(['id'=>$country->id,'title'=>$title]);
    }
    
    public function get_form_country(Request $request)
    {
        $store = Country::find($request->id);
        return view('dashboard.country.edit')->with('country',$store);

    }
    public function update_country(Request $request,$id){
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'code'=>'required',

        ]);
        $country = Country::find($id);
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        if($request->flag != null){
            $country->flag = $request->flag->store('country');
        }
        $country->code = $request->code;
        $country->save(); 
        return $country;
    }

   
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);

    }
}
