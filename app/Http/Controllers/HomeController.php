<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Banner, ServiceCharge};
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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


    public function getCharges(){
        $serviceCharge = ServiceCharge::first();
        return response()->json([
            'data' => $serviceCharge
        ], 200);
    }

    public function getBanners(){
        $banners = Banner::where('display_status', true)->get();
        return response()->json([
            'data' => $banners
        ], 200);
    }
}
