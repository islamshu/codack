<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.stores.index')->with('stores',Stores::orderby('id','desc')->get());
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'image'=>'required'
        ]);
        $store = new Stores();
        $store->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
        $store->image = $request->image->store('store');
        $store->commercial_register = $request->commercial_register;
        $store->website = $request->website;
        $store->android = $request->android;
        $store->ios = $request->ios;
        $store->save();
        $count = Stores::count() ;
        return view('dashboard.stores._stores')->with('store',$store)->with('key',$count);
    }
    public function get_form_stores(Request $request)
    {
        $store = Stores::find($request->id);
        return view('dashboard.stores.edit')->with('store',$store);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function show(Stores $stores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function edit(Stores $stores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
        ]);
        $store = Stores::find($id);
        if($request->image != null){
            $store->image = $request->image->store('store');
        }
        $store->title =['ar'=>$request->title_ar,'en'=>$request->title_en];
        $store->website = $request->website;
        $store->android = $request->android;
        $store->ios = $request->ios;
        $store->commercial_register = $request->commercial_register;
        $store->save();
        return $store;
    }
    public function update_stores(Request $request,$id)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
        ]);
        $store = Stores::find($id);
        if($request->image != null){
            $store->image = $request->image->store('store');
        }
        $store->title =['ar'=>$request->title_ar,'en'=>$request->title_en];
        $store->website = $request->website;
        $store->android = $request->android;
        $store->ios = $request->ios;
        $store->commercial_register = $request->commercial_register;
        $store->save();
        return $store;
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sotre =Stores::find($id);
        $sotre->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
