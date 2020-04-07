<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StringForAuth extends Model
{
    protected $sendMailResetSuccess = "Success send mail reset password!";
    protected $sendMailResetError   = "Error send mail reset password!";

    protected $confirmPassError     = "Your must cofirm password!";

    protected $resetPassSuccess     = "Password has reset!";
    protected $resetPassError       = "Error reset password!";

    public static function getSendMailResetSuccess(){
        $obj = new StringForAuth();
        return $obj->sendMailResetSuccess;
    }

    public static function getSendMailResetError(){
        $obj = new StringForAuth();
        return $obj->sendMailResetError;
    }

    public static function getConfirmPassError(){
        $obj = new StringForAuth();
        return $obj->confirmPassError;
    }

    public static function getResetPassSuccess(){
        $obj = new StringForAuth();
        return $obj->resetPassSuccess;
    }

    public static function getResetPassError(){
        $obj = new StringForAuth();
        return $obj->resetPassError;
    }
}
