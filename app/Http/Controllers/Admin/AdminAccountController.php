<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\EmailGetRequest;
use App\Http\Requests\ResetPasswordPostRequest;
use Illuminate\Support\Str;
use App\Mail\ConfirmRegister;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\ResetPassword;
use App\User;
use App\StringForAuth;

class AdminAccountController extends Controller
{

    public function index()
    {
        return redirect('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->index();
    }

    //Function login account 
    public function store(LoginPostRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        $remember = false;

        if(Auth::check()){
            return redirect('admin');
        }
        
        if($request->input('selector-remember')){
            $remember = true;
        }

        if(Auth::attempt([
            'name'             => $username, 
            'password'         => $password,
            ])){

            $user = Auth::user();  

            if($user->roles_id == 3){
                Auth::logout();
                return redirect('cus')->with('msg','You is Customer!');
            }

            if($remember){
                $response = new Response();
                $response->withCookie(cookie()->forever('username', $username))
                            ->withCookie(cookie()->forever('password', $password))
                            ->withCookie(cookie()->forever('remember', true));
            }
            else{
                \Cookie::forget('username');
                \Cookie::forget('password');
                \Cookie::forget('remember');
            }
            return redirect('admin');
        }
        return redirect('admin/account')->with('msg','Not accept!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->index();
    }

    //Function get email reset password
    public function edit(EmailGetRequest $request)
    {
        $email = $request->email;
        
        if(User::sendMailReset($email, true)){
            return redirect('admin/account')->with('msg', StringForAuth::getSendMailResetSuccess());
        }else{
            return redirect('admin/account/forget')
                ->with('msg', StringForAuth::getSendMailResetError());
        }
    }

    // Function reset password
    public function update(ResetPasswordPostRequest $request)
    {
        if ($request->password != $request->confirmpassword) {
            return redirect(url()->previous())->with('msg', StringForAuth::getConfirmPassError());
        }

        $email = $request->email;
        $mytoken = $request->mytoken;
        $password = $request->password;

        if (User::resetPassword($email, $password, $mytoken)) {
            return redirect('admin/account')->with('msg', StringForAuth::getResetPassSuccess());
        }
        else{
            return redirect(url()->previous())->with('msg', StringForAuth::getResetPassError());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->index();
    }

    function pageResetPass($mytoken = "", $email = ""){
        if(User::canResetPassword($mytoken, $email)){
            return view('admin.reset-password', ['email'=> $email, 'mytoken'=>$mytoken]);
        }else{
            return redirect('4040404040404040404040404040404040404040404404040404');
        }   
    }

    function pageLogin(){
        return view('admin.login');
    }

    function pageForget(){
        return view('admin.forget-pass');
    }

    function logout(){
        Auth::logout();
        return redirect('admin/account');
    }
}
