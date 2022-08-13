<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Famous;
use App\Models\FamousSoial;
use App\Models\FamousType;
use App\Models\SoicalType;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class FamousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stores = Famous::query();
        $stores->when($request->famous_id, function ($q) use ($request) {
            $q->where('id', $request->famous_id);
        });
        $stores->when($request->country_id, function ($q) use ($request) {
            $q->where('country_id', $request->country_id);
        });

        $store = $stores->orderby('id', 'desc')->get();
        return view('dashboard.famous.index')
        ->with('stores',Stores::get())
        ->with('famous', $store)
        ->with('countries', Country::get())
        ->with('typs', FamousType::get())
        ->with('soicals', SoicalType::get())
        ->with('request',$request);

    }
    public function get_country_code(Request $request)
    {
        $country = Country::find($request->id);
        return $country;
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
        
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'country_id' => 'required',
            'phone' => 'required|unique:famouses,phone|unique:users,phone',
            'email' => 'email|required|unique:famouses,email|unique:users,phone',
            'professional_license_number' => 'required',
            'is_famous' => 'required',
            'famoustype_id' => 'required',
            'follower_type' => 'required',
        ]);
        $famous = new Famous();
        $famous->image = $request->image->store('famous_image');
        $famous->name = $request->name;
        $famous->country_id = $request->country_id;
        $famous->phone = $request->phone;
        $famous->email = $request->email;
        $famous->professional_license_number = $request->professional_license_number;
        $famous->is_famous = $request->is_famous;
        $famous->views_number = $request->views_number;
        $famous->followers_number = $request->followers_number;

        $famous->famoustype_id = json_encode($request->famoustype_id);
        $famous->follower_type = json_encode($request->follower_type);
        $famous->name_actor = $request->name_actor;
        $famous->phone_actor = $request->phone_actor;
        $famous->tiktok = $request->tiktok;
        $famous->instagram = $request->instagram;
        $famous->snapchat = $request->snapchat;
        $role = Role::where('name','Famous')->first();
        $user = User::where('phone',$request->phone)->first();
        if(!$user){
        $user= new User();
        $user->name = $famous->name;
        $user->email = $famous->email;
        $user->phone = $famous->phone;
        $user->otp = rand(1111,9999);
        $user->save();
        $user->assignRole([$role->id]);
        $famous->user_id = $user->id;
    }
        $famous->save();
       


        $count = Famous::count();
        if($request->addmore != null){
            foreach($request->addmore as $key=>$val){
                foreach($val as $kery=>$f){
                    
                    $blog = FamousSoial::create([
                        'famous_id'    => $famous->id,
                        'social_title' => $kery,
                        'social_url' => $f
                    ]);
                }
    
            }
      
    }
        return view('dashboard.famous._famous')->with('item', $famous)->with('key', $count);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Famous  $famous
     * @return \Illuminate\Http\Response
     */
    public function show(Famous $famous)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Famous  $famous
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.famous.edit')->with('famous', Famous::find($id))->with('countries', Country::get())->with('typs', FamousType::get())->with('soicals', SoicalType::get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Famous  $famous
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'phone' => 'required|unique:famouses,phone,'.$id,
            'email' => 'email|required|unique:famouses,email,'.$id,
            'professional_license_number' => 'required',
            'is_famous' => 'required',
            'famoustype_id' => 'required',
            'follower_type' => 'required',
        ]);
        $famous = Famous::find($id);
        if ($request->image != null) {
            $famous->image = $request->image->store('famous_image');
        }
        $famous->name = $request->name;
        $famous->country_id = $request->country_id;
        $famous->phone = $request->phone;
        $famous->email = $request->email;
        $famous->professional_license_number = $request->professional_license_number;
        $famous->is_famous = $request->is_famous;
        $famous->views_number = $request->views_number;
        $famous->followers_number = $request->followers_number;
        $famous->name_actor = $request->name_actor;
        $famous->phone_actor = $request->phone_actor;

        $famous->famoustype_id = json_encode($request->famoustype_id);
        $famous->follower_type = json_encode($request->follower_type);
        $famous->tiktok = $request->tiktok;
        $famous->instagram = $request->instagram;
        $famous->snapchat = $request->snapchat;
    //     $role = Role::where('name','Famous')->first();
        $user = $famous->user;
            
        $user->otp = rand(1111,9999);
        $user->phone = $request->phone;
        $user->save();
    
    //    $famous->user_id = $user->id;
        $famous->save();
      
        
        

        if($request->addmore != null){
           
            foreach(FamousSoial::where('famous_id',$famous->id)->get() as $fa){
                $fa->delete();
            }
            foreach($request->addmore as $key=>$val){
                foreach($val as $kery=>$f){
                    
                    $blog = FamousSoial::create([
                        'famous_id'    => $famous->id,
                        'social_title' => $kery,
                        'social_url' => $f
                    ]);
                }
    
            }
        }else{
            foreach(FamousSoial::where('famous_id',$famous->id)->get() as $fa){
                $fa->delete();
            } 
        }
        return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Famous  $famous
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Famous::find($id);
        $country->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }
}
