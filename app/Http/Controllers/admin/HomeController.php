<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /* Dashboard Page */
    public function index(){
        // $userCount = User::getlistDashboardUserCount();
        // $customerCount = User::getlistDashboardCustomerCount();
        // $registerCustomersYearsData = User::getRegisterCustomersYearsData();
        return view('admin.dashboard.index');
    }
    
    /* Success Page */
    public function success(Request $request){
        return view('admin.dashboard.success');
    }

    /* Page Not Found */
    public function notFound(Request $request){
        return view('admin.errors.404');
    }

    /* Exceptions Page */
    public function exceptions(Request $request){
        return view('admin.errors.500');
    }

    /* Unauthorized Page */
    public function unauthorized(Request $request){
        return view('admin.errors.401');
    }
    
     /* Set Time Zone in Sesstion For date display USE Start*/
    public function settimezone(Request $request){
        $data = $request->all();
        session()->put('customTimeZone', $data['timezone']);
    }

    /* Terms and conditions */
    public function termsAndConditions(){
        $data = Cms::getCMSPage('',config('const.terms-and-conditions'));
        return view('admin.user.terms-and-conditions',compact('data'));
    }

    /* Privacy policy */
    public function privacyPolicy(){
        $data = Cms::getCMSPage('',config('const.privacy-policy'));
        return view('admin.user.privacy-policy',compact('data'));
    }
    
}
