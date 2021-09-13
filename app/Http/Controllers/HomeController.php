<?php

namespace App\Http\Controllers;

use App\Models\PaypalPlan;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Plan;

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

    public function payment(){

        $website = Website::where('user_id', Auth::user()->id)->first();
        $id = $website->plan;
        $get_plan = PaypalPlan::findOrFail($id);

        return view('payment', compact('id', 'website', 'get_plan'));
    }
    public function website_details($website){
        $website = Website::findOrFail($website);
        return view('website-details', compact( 'website'));
    }

}
