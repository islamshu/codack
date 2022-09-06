<?php

namespace App\Http\Controllers;

use App\Models\SoicalType;
use Illuminate\Http\Request;

class SoicalTypeController extends Controller
{
   
    public function index()
    {
        return view('dashboard.soical.index')->with('soicals',SoicalType::orderby('id','desc')->get());
    }
    public function get_form_soical(Request $request)
    {
        $store = SoicalType::find($request->id);
        return view('dashboard.soical.edit')->with('soical',$store);

    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'icon'=>'required|dimensions:min_width=30,min_height=30'
            
        ]);
        $soical = new SoicalType();
        $soical->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $soical->icon = $request->icon->store('soical');

        $soical->save();
        $count = SoicalType::count() ;
        return view('dashboard.soical._soical')->with('soical',$soical)->with('key',$count);
    }
   
    public function store_socail_for_famous(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'icon'=>'required|dimensions:min_width=30,min_height=30'
            
        ]);
        $soical = new SoicalType();
        $soical->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $soical->icon = $request->icon->store('soical');

        $soical->save();
        $count = SoicalType::count() ;

        if(get_lang()=='ar'){
            $title = $request->title_ar;
        }else{
            $title = $request->title_en;
        }
        return response()->json(['id'=>$soical->id,'title'=>$title]);    }


    public function update_soical(Request $request,$id){
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
        ]);
        
        $soical = SoicalType::find($id);
        $soical->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        if($request->icon != null){
            $request->validate([
                'icon'=>'required|dimensions:max_width=30,max_height=30'  
            ]);
            $soical->icon = $request->icon->store('soical');
        }
        $soical->save(); 
        return $soical;
    }

   
    public function destroy($id)
    {
        $soical = SoicalType::find($id);
        $soical->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);

    }
}
