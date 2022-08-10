<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $stores = Stores::query()->has('codes');
        // // $stores->when($request->store_id, function ($q) use ($request) {
        // //     $q->where('id', $request->store_id);
        // // });
        // $stores->when($request->famous_discount_from != null || $request->famous_discount_to != null , function ($q) use ($request) {
        //     $q->whereHas('codes', function ($q) use ($request) {
        //         $q->where('discount_percentage',$request->famous_discount_to);
        //         dd($q->get());

        //     });
            
        // });

        $store = Stores::query()->orderby('id', 'desc')->get();
        // dd($store);



        
        return view('dashboard.stores.index')->with('stores', $store)->with('request',$request);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'image' => 'required'
        ]);
        $store = new Stores();
        $store->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
        $store->image = $request->image->store('store');
        $store->commercial_register = $request->commercial_register;
        $store->website = $request->website;
        $store->android = $request->android;
        $store->ios = $request->ios;
        $store->added_by = auth()->id();
        $store->save();
        $count = Stores::count();
        return view('dashboard.stores._stores')->with('store', $store)->with('key', $count);
    }
    public function get_form_stores(Request $request)
    {
        $store = Stores::find($request->id);
        return view('dashboard.stores.edit')->with('store', $store);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
        ]);
        $store = Stores::find($id);
        if ($request->image != null) {
            $store->image = $request->image->store('store');
        }
        $store->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
        $store->website = $request->website;
        $store->android = $request->android;
        $store->ios = $request->ios;
        $store->commercial_register = $request->commercial_register;
        $store->save();
        return $store;
    }
    public function update_stores(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
        ]);
        $store = Stores::find($id);
        if ($request->image != null) {
            $store->image = $request->image->store('store');
        }
        $store->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
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
        $sotre = Stores::find($id);
        $sotre->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }
}
