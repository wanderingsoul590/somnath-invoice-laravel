<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use App\Models\MenuPermission;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index()
    {
        $permission = Helper::checkModuleAccess(config('const.UsersMenuID'));
        if(!$permission){
            return redirect()->route('401unauthorized');
        }
        $usersData = User::getlistDashboardUserCount();
        return view('admin.users.index',compact('usersData'));
    }

    public function create()
    {
        try{ 
            $users_role = User::getUsersRole();
            $permission = Helper::checkModuleAccess(config('const.UsersMenuID'));
            if(!$permission){
                return redirect()->route('401unauthorized');
            }
            $status = Helper::Userstatus();
            $side_menu = User::getMenuTablelist();
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
        return view('admin.users.create',compact('users_role','status','side_menu'));
    }

    public function store(Request $request)
    {
        try{       
          
            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'status' =>'required',
                'role_id' =>'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/',
                    // must contain a special character
                ],'password_confirmation' => ['same:password']);

            $messsages = array(
                'password.regex' => trans('admin.strongPassword'),
            );
            $validator = Validator::make($request->all(), $rules,$messsages);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            /* Validate Emai exist */
            if($request->email && $request->email != ''){
                //$emailexist = User::where('email','=',$request->email)->first();
                $emailexist = DB::table('users')->where('email','=',$request->email)->first();
                if($emailexist){
                    return back()->withInput()->withErrors(trans('admin.emailExists'));
                }
            }

            $return_response = User::AdminUsersSave($request);
            if($return_response){
                session()->flash('success', trans('admin.userscreatesuccess'));
                return redirect()->route('users.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('users.create');
            }
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    public function show($id)
    {
        try{
            $permission = Helper::checkModuleAccess(config('const.UsersMenuID'));
            if(!$permission){
                return redirect()->route('401unauthorized');
            }
            $data = User::getUserDetails($id);
            return view('admin.users.show',compact('data'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('users.index');
        }
    }

    public function edit($id)
    {
        $permission = Helper::checkModuleAccess(config('const.UsersMenuID'));
        if(!$permission){
            return redirect()->route('401unauthorized');
        }
        $users_role = User::getUsersRole();
        $status = Helper::Userstatus();
        $side_menu = User::getMenuTablelist();
        $data = User::where('id',$id)->first();
        $menusPermissions = MenuPermission::where('user_id',$id)->get();
        if($menusPermissions){
            if($side_menu){
                foreach ($side_menu as $menusData){
                    foreach ($menusPermissions as $menusPermissionsData){
                        if($menusData->id == $menusPermissionsData->menu_id && $menusPermissionsData->read==1){
                            $menusData->is_read='checked';
                        }
                        if($menusData->id == $menusPermissionsData->menu_id && $menusPermissionsData->write==1){
                            $menusData->is_write='checked';
                        }
                    }
                }
            }
        }
        return view('admin.users.edit',compact('data','users_role','status','side_menu'));
    }

    public function update(Request $request, $id)
    {
        try{     
            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'status' =>'required',
                );

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
           
            /* Validate Emai exist */
            if($request->email && $request->email != ''){
                $emailexist = DB::table('users')->where('email','=',$request->email)->where('id','!=',$id)->first();
                if($emailexist){
                    return back()->withInput()->withErrors(trans('admin.emailExists'));
               }
            }

            $updateusers = User::AdminUsersUpdate($request,$id);
            if($updateusers){
                session()->flash('success',  trans('admin.usersupdatesuccess'));
                return redirect()->route('users.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('users.create');
            }
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $data_del = User::where('id',$id)->delete();
            return Response::json($data_del);
        }catch(\Exception $e){
            return Response::json($e);
        }    
    }

    /* Get Admin List */
    public static function postUsersList(Request $request){ 
        try{           
           return User::postUsersList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('users.create');
        } 
    }    

    /* My profile Start*/
    public function myProfile(){
        try{
            $data = User::getUserDetails(Auth::user()->id);
            return view('admin.user.myprofile',compact('data'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('myprofile');
        }
    }

    /* Update My Profile */
    public function updateMyProfile(Request $request){
        try{       
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' =>'required|email|unique:users,email,'.Auth::user()->id,
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            
            User::updateMyProfile($request);
            
            session()->flash('success',  trans('admin.updatemyProfile'));
            return redirect()->route('myprofile');
        }catch(\Exception $e){  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }
    
    /* Change Password*/
     public function storeChangePassword(Request $request){

        try{
            
            $rules = array(
                'currentpassword' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'password_confirmation' => ['same:password'],
            );
            
            $messsages = array(
                'password.regex' => trans('admin.strongPassword'),
            );
            $validator = Validator::make($request->all(), $rules,$messsages);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            if(!Hash::check($request->currentpassword, auth()->user()->password)){
                session()->flash('error', trans('admin.currentPasdswordNotmatch'));
                return redirect()->route('myprofile');
            }

            $data = \App\Models\User::find(Auth::user()->id);
            $data->password = bcrypt($request->password);
            $data->save();

            session()->flash('success', trans('admin.passwordChanged'));
            return redirect()->route('myprofile');
        
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('myprofile')->withInput();
        }
    }

    /* Verify Email */
    public function activation($token=''){
        try{
            $data = User::where('email',Crypt::decryptString($token))->first();
            if($data)
            {
                User::where(['email'=>Crypt::decryptString($token)])->update(['email_verified_at'=>Carbon::now()]);
                session()->flash('success', trans('admin.emailverified'));
                return redirect()->route('success');
            }
            else
            {
                session()->flash('error', trans('admin.emailverifyfail'));
                return redirect()->route('success');
            }
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('success');
        }
    }
}
