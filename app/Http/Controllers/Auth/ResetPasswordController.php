<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Password_Resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /* Forgot Password Email Index  */
    public function index(){
        return view('auth.passwords.reset');
    }

    /* Forgot Password Email */
    public function resetPasswordSendEmail(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('email',$request->email)->first();
        // $user = User::where('email',$request->email)->whereIn('role_id',[1])->first();
        if(!$user){
            session()->flash('error', trans('admin.notfoundEmail'));
            return redirect()->route('showLoginForm');
        }

        try{

            $token = Crypt::encryptString($request->email);

            Password_Resets::updateOrCreate(
            [
                'email' => $request->email
            ], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
            ])->forgotLink($token, $request->email,'',$user->name);

            session()->flash('success', trans('admin.forgotPassword'));
            return redirect()->route('showLoginForm');
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('showLoginForm');
        }
    }

    /* Reset Password Form */
    public function showPasswordResetForm($token,$isMobile=''){
        try{
            $tokenData = DB::table('password_resets')->where('token',$token)->first();
            if ( !$tokenData ){
                session()->flash('error', trans('admin.InvalidResetPassword'));
                return redirect()->to('/login');
            }
            return view('auth.passwords.reset',array('token'=>$token,'isMobile'=>$isMobile));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('resetpasswordform');
        }
    }

    /* Reset Password  */
    public function resetPassword(Request $request,$token,$isMobile='') {
        $rules = array(
           //'currentpassword' => 'required',
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
       try{
           $password = $request->password;
           $tokenData = DB::table('password_resets')->where('token', $token)->first();

           $user = User::where('email', $tokenData->email)->first();
           if ( !$user ) {
               session()->flash('error', trans('admin.InvalidResetPassword'));
               return redirect()->to('password/reset');
           }

           $user->password = Hash::make($password);
           $user->status = config('const.statusActiveInt');
           $user->update();

           DB::table('password_resets')->where('email', $user->email)->delete();

           session()->flash('success', trans('admin.passwordResetSuccess'));
           return redirect()->route('showLoginForm');

        }catch(\Exception $e){
           session()->flash('error',$e->getMessage());
           return redirect()->route('showLoginForm');
       }
   }
}
