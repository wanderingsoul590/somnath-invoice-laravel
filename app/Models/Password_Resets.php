<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Event;
use App\Jobs\SendEmailJob;

class Password_Resets extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    public $timestamps = false;
    protected $primaryKey ='email';
	
    protected $fillable = [
        'email','token','created_at'
    ];

    public function forgotLink($token,$email,$isMobile='',$name='')
    {          
        dispatch(new SendEmailJob([
            '_blade'=>'forgot',
            'subject'=>trans('email.resetPassword'),
            'email'=>$email,
            'name'=>$name,
            'token'=>$token,
            'url'=>  \Illuminate\Support\Facades\URL::to('/').'/forgot-password/'.$token,
            'ismobile'=>$isMobile
        ]));
    }
}
