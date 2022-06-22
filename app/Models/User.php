<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use URL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Get Customers List */
    public static function postCustomersList($request)
    {

        $query = User::select('users.*');

        if ($request->order == null) {
            $query->orderBy('users.id', 'desc');
        }

        return Datatables::of($query)
            ->addColumn('action', function ($data) {
                $editLink = URL::to('/') . '/admin/customers/' . $data->id . '/edit';
                $viewLink = URL::to('/') . '/admin/customers/' . $data->id;
                $deleteLink = $data->id;
                return Helper::Action($editLink, $deleteLink, $viewLink);
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /* Check Email */
    public static function checkEmail($email, $id = '')
    {
        $query = DB::table('users')->where('email', $email);
        if ($id != '') {
            $query->where('id', '!=', $id);
        }
        return $query->first();
    }

    /* Create & Update Customer */
    public static function createEditCustomer($request,$id=''){
        if($id !=''){
            $data = User::find($id);
        }else{
            $data = new User();
        }

        $data->name = isset($request->first_name) && isset($request->last_name) ? $request->first_name . " " . $request->last_name : null;
        $data->first_name = isset($request->first_name) ? $request->first_name : null;
        $data->last_name = isset($request->last_name) ? $request->last_name : null;
        $data->email = isset($request->email) ? $request->email : null;
        $data->phone_no = isset($request->phone_no) ? $request->phone_no : null;
        $data->address = isset($request->address) ? $request->address : null;
        $data->role_id = config('const.roleCustomer');
        $data->status = config('const.statusActiveInt');
        $data->save();

        return $data;
    }

    /* Get User Details */
    public static function getUserDetails($id)
    {
        $data = User::find($id);
        return $data;
    }

    /* Update Profile */
    public static function updateMyProfile($request)
    {
        $data = User::find(Auth::user()->id);

        if (isset($request->name) && $request->name != '') {
            $data->name = $request->name;
        }

        if (isset($request->email) && $request->email != '') {
            $data->email = $request->email;
        }

        $data->save();
        return self::getUserDetails($data->id);
    }

    /* Send Email */
    public static function sendEmail($request)
    {
        dispatch(new SendEmailJob([
            '_blade' => 'sendemail',
            'subject' => $request->subject,
            'email' => $request->email,
            'cc' => $request->cc,
            'bcc' => $request->bcc,
            'msg' => $request->msg
        ]));
    }

}
