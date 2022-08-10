<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function notification($id)
    {
        $not = Notification::find($id);
        $not->read_at = Carbon::now();
        $not->save();
        return redirect(json_decode($not->data)->url);
    }
    public function read_all_notofication()
    {
        $notifications = auth()->user()->unreadNotifications;
        foreach ($notifications as $notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
        }
    }
    public function general()
    {
        return view('dashboard.general');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('general_file')) {
            foreach ($request->file('general_file') as $name => $value) {
                if ($value == null) {
                    continue;
                }
                General::setValue($name, $value->store('general'));
            }
        }

        foreach ($request->input('general') as $name => $value) {
            if ($value == null) {
                continue;
            }
            General::setValue($name, $value);
        }

        session()->flash('success', 'تم تحديث البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
