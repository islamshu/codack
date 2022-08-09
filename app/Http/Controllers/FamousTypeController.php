<?php

namespace App\Http\Controllers;

use App\Models\FamousType;
use Illuminate\Http\Request;

class FamousTypeController extends Controller
{
   
    public function index()
    {
        return view('dashboard.famoustype.index')->with('famoustype',FamousType::orderby('id','desc')->get());
    }
    public function get_form_famoustype(Request $request)
    {
        $store = FamousType::find($request->id);
        return view('dashboard.famoustype.edit')->with('famous',$store);

    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required'
        ]);
        $country = new FamousType();
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];

        $country->save();
        $count = FamousType::count() ;
        return view('dashboard.famoustype._famous')->with('famous',$country)->with('key',$count);
    }
    public function store_scope_for_famous(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required'
        ]);
        $country = new FamousType();
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];

        $country->save();
        $count = FamousType::count() ;
        if(get_lang()=='ar'){
            $title = $request->title_ar;
        }else{
            $title = $request->title_en;
        }
        return response()->json(['id'=>$country->id,'title'=>$title]);
    }

    public function update_famoustype(Request $request,$id){
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',

        ]);
        $country = FamousType::find($id);
        $country->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $country->save(); 
        return $country;
    }

   
    public function destroy($id)
    {
        $country = FamousType::find($id);
        $country->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);

    }
}
