<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class AdminAuthController extends Controller
{
    //
   

    use AuthenticatesUsers;


    protected $redirectTo ='/admin/dashboard';


    public function __construct(){
        $this->middleware('guest',['except'=> 'logout']);
    }

    public function getLogin(){
        if(!Auth::guard('admin')->guest()){
            return redirect($this->redirectTo);
        }
        return view('auth.admin.login');
    }

    public function postLogin(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
                $user = auth()->guard('admin')->user();
                Session::put('success','You are Login successful !!');
                return redirect('/admin/dashboard');
                // return view('dashboard.dashboard');
            }else{
                return back()->with('error','Wrong Admin Credentials');
            }
    }


    public function logout()
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success','You are logout successfully');
        return redirect(route('adminLogin'));
    }
}
