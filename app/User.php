<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mail\ConfirmRegister;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function deleteRequestResetPass($email){
        ResetPassword::where('email', '=', $email)->delete();
    }

    static function sendMailReset($email, $isAdmin){

        $obj = new User();
        $mytoken = Str::random(50);
        $url = "admin/account/resetpassword/";

        if (!$isAdmin) {
            $url = "cus/resetPass/";
        }
       
        try {
            $obj->deleteRequestResetPass($email);
            
            ResetPassword::insert([
                'email' => $email,
                'token' => $mytoken,
                'created_at'=>now()
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        try {
            
            $user_ = User::where('email', $email)->first();
            Mail::to($email)->send(new ResetPasswordMail($user_->name, $url, $mytoken, $email));
            
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    static function resetPassword($email, $password, $token){
        $obj = new User();
        if ($obj->canResetPassword($token, $email)) {
            try {
                $user = User::where('email', '=', $email)->first();
                $user->password = bcrypt($password);
                $user->save();
                
            } catch (\Throwable $th) {
                return false;
            }
            $obj->deleteRequestResetPass($email);
            return true;
        }
        return false;
    }

    static function canResetPassword($mytoken, $email){
        $modelToken = ResetPassword::where('token', '=', $mytoken)->first();
        $modelEmail = ResetPassword::where('email', '=', $email)->first();
        
        if($modelEmail == null){
            return false;
        }

        if($modelEmail == $modelToken){
            // Betwen for 30 minutes
            $time = $modelToken->created_at;
            $obj = new User();
            if($obj->stillTime($time, 30)){
                return true;
            }
        }

        return false;
    }

    private function stillTime($time, $minutes){
        if(now()->year >= $time->year){
            if(now()->month >= $time->month){
                if(now()->day > $time->day){
                   return true;                  
                }
                if(now()->day == $time->day){
                    $total_time_cr = $time->second + $time->minute*60 + $time->hour*60*60;
                    $total_time_now = now()->second + now()->minute*60 + now()->hour*60*60;

                    if($total_time_now-$total_time_cr <= $minutes*60) //30 minutes
                    {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    //Functions for ajax page Admin:
    public static function myInsert($username, $password, $email, $role){
        try {
            $obj            = new static;
            $obj->name      = $username;
            $obj->password  = bcrypt($password);
            $obj->email     = $email;
            $obj->roles_id  = $role;
            $obj->save();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function myUpdate($id, $username, $password, $email, $role){
        try {
            $obj            = static::find($id);
            $obj->name      = $username;
            $obj->password  = bcrypt($password);
            $obj->email     = $email;
            $obj->roles_id  = $role;
            $obj->save();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function myDelete($username, $password, $email, $role){
        
    }

    public static function myFindOne($id){
        try {
            $obj = static::find($id);
            return $obj;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
