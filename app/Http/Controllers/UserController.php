<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Changbank;
use App\Models\Country;
use App\Models\Famous;
use App\Models\FamousBank;
use App\Models\FamousSoial;
use App\Models\FamousType;
use App\Models\SoicalType;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function admin_login(){
        return view('auth.user.login');
    }
    public function famous_login(){
        return view('auth.user.famous_login');
    }
    public function famous_login_post(Request $request){
        $user = Famous::where('phone',$request->phone)->first();
        if($user){
            $meesage = 'رمز التحقق هو '.$user->otp;
            return response()->json(['status'=>true,'message'=>$meesage,'phone'=>$request->phone]);
        }else{
            return response()->json(['status'=>false,'message'=>'لم يتم العثور على رقم الهاتف']);
        }
    }
    public function check_otp(Request $request){
        $user = Famous::where('phone',$request->phone)->where('otp',$request->otp)->first();
        if($user){
            

            auth('famous')->login($user, true);
            $admin = Auth::user();
            if($admin){
                Auth::logout(); 
            }
            return response()->json(['status'=>true,'redirecturl'=>route('famous-dashboard')]);

        }else{
            return response()->json(['status'=>false,'message'=>'رمز التحقق خاطيء']);
        }
    }
    
    public function process_login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard/home');
        }else{
            return redirect()->back()->with(['error'=>'البيانات غير متطابقة مع سجلاتنا']);
        }
    }
    public function send_bank_data(Request $request){
        $famous = FamousBank::where('famous_id',auth('famous')->id())->first();
        if($famous){
            return response()->json(['status'=>true,'message'=>'تم ارسال طلب التحويل بنجاح']);
        }else{
            $famouss = new FamousBank();
            $famouss->famous_id = auth('famous')->id();
            $famouss->bank_name = $request->bank_name;
            $famouss->account_name = $request->account_name;
            $famouss->account_nubmer = $request->account_number;
            $famouss->save();
            return response()->json(['status'=>true,'message'=>'تم تخزين بيانات البنك وارسال الطلب']);

        }

    }
    
    public function update_my_profile(Request $request)
    {
        $famous = Famous::find(auth('famous')->id());

        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'phone' => 'required|unique:famouses,phone,'.auth('famous')->id(),
            'email' => 'email|required|unique:famouses,email,'.auth('famous')->id(),
            'professional_license_number' => 'required',
            'is_famous' => 'required',
            'famoustype_id' => 'required',
            'follower_type' => 'required',
        ]);
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

        $famous->famoustype_id = json_encode($request->famoustype_id);
        $famous->follower_type = json_encode($request->follower_type);
        $famous->name_actor = $request->name_actor;
        $famous->phone_actor = $request->phone_actor;
        $famous->tiktok = $request->tiktok;
        $famous->instagram = $request->instagram;
        $famous->snapchat = $request->snapchat;
        $famous->save();
        if($request->addmore != null){
            foreach(FamousSoial::where('famous_id',$famous->id)->get() as $fa){
                $fa->delete();
            }
            foreach ($request->addmore as $key => $value) {

                $blog = FamousSoial::create([
                    'famous_id'    => $famous->id,
                    'social_title' => $value['name_socal'],
                    'social_url' => $value['url']
                ]);
            }
        }
        return redirect()->back()->with(['success'=>'تم التعديل بنجاح']);
        
    }
    public function codes(){
        return view('dashboard.codes.index');
    }
    
    public function edit_profile()
    {
        return view('dashboard.user.edit')->with('famous', Famous::find(auth('famous')->id()))->with('countries', Country::get())->with('typs', FamousType::get())->with('soicals', SoicalType::get());
    }
    public function edit_bank_profile()
    {
        return view('dashboard.user.edit_bank_profile')->with('famous', Famous::find(auth('famous')->id()))->with('countries', Country::get())->with('typs', FamousType::get())->with('soicals', SoicalType::get());
    }
    public function update_back_info(Request $request)
    {
       $bank = Changbank::where('famous_id',auth('famous')->id())->first();
       if($bank){
        return redirect()->back()->with(['error'=>'لقد تم ارسال طلب مسبقا بانتظار الموافقة من قبل الادارة']);
       }else{
        $bank = new Changbank();
        $bank->bank_name = $request->bank_name;
        $bank->account_name = $request->account_name;
        $bank->account_number = $request->account_number;
        $bank->famous_id = auth('famous')->id();
        $bank->save();
        return redirect()->back()->with(['success'=>'تم ارسال طلبك بنجاح']);


       }
       

    }

    
    public function wallet()
    {
       return view('dashboard.wallet.index');
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function logout(){
        if(auth()->user() != null){
            auth()->logout();
            return redirect()->route('admin_login');
        }else{
            auth('famous')->logout();
            return redirect()->route('famous_login');

        }
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
