<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegister;
use App\Mail\ResetPasswordMail;
use Auth\VerificationController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Response;
use App\User;
use App\ResetPassword;

class CustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch($request->input('action')){
            case "login":
                
                $request->validate([
                    'username' =>'required|min:6|regex:/^\S*$/u',
                    'password' =>'required|min:6|regex:/^\S*$/u'
                ]);

                $username = $request->input('username');
                $password = $request->input('password');
                $remember = false;

                if($request->input('selector-remember')){
                    $remember = true;
                }

                if(Auth::attempt([
                    'name'             => $username, 
                    'password'         => $password])){

                    $user = Auth::user();  

                    if($user->roles_id != 3){
                        Auth::logout();
                        return redirect('cus')->with('msg','You is Admin!');
                    }

                    if($user->email_verified_at != ''){

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
                        return redirect('cus/profile');
                    }else{
                        Auth::logout(); 
                        return redirect('cus')->with('msg','Account need Verified!');
                    }
                }
                
            break;
            case "register":

                if($request->input('confirmpassword') != $request->input('password')){
                    return redirect('cus/register')->with('msg', 'Pls Confirm your password!');
                }
                
                $request->validate([
                    'email'    =>'required|unique:users,email',
                    'username' =>'required|min:6|regex:/^\S*$/u|unique:users,name',
                    'password' =>'required|min:6|regex:/^\S*$/u',
                    'confirmpassword' =>'required|min:6|regex:/^\S*$/u'
                ]);

                $email    = $request->input('email');
                $username = $request->input('username');
                $password = $request->input('password');
                $confirmPassword = $request->input('confirmpassword');
                $remember = false;
                $mytoken  = Str::random(50);

                if($request->input('selector-remember')){
                    $remember = true;
                }

                try {
                    $usernew                 = new User();
                    $usernew->name           = $username;
                    $usernew->email          = $email;
                    $usernew->password       = bcrypt($password);
                    $usernew->roles_id       = 3;
                    $usernew->remember_token = $mytoken;
                    if($usernew->save()){
                        $user_ = User::orderBy('id','DESC')->first();
                        $id_   = $user_->id;
                        $status = true;
                    }
                    else
                        $status = false;

                } catch (\Throwable $th) {
                    $status = false;
                }

                try {
                    if($status){
                        Mail::to($email)->send(new ConfirmRegister($username, $mytoken, $id_));
                    }
                } catch (\Throwable $th) {

                    $user_->delete();

                    return redirect('cus/register')->with('msg', 
                        'Error send Email! Please wait two minute ._.');
                }

                return redirect('cus')
                    ->with('msg', 'Please confirm mail and login here!');
                
            break;
            case "reset-password":
                $url = 'cus/resetPass/'.$request->input('mytoken').'/'.$request->input('email');
                
                if($request->input('confirmpassword') != $request->input('password')){
                    return 
                        redirect($url)->with('msg', 'Please confirm your password!');
                }
                
                $request->validate([
                    'mytoken'  =>'required',
                    'email'    =>'required|',
                    'password' =>'required|min:6|regex:/^\S*$/u',
                    'confirmpassword' =>'required|min:6|regex:/^\S*$/u'
                ]);

                $mytoken  = $request->input('mytoken');
                $email    = $request->input('email');
                $password = $request->input('password');
                $confirmPassword = $request->input('confirmpassword');

                try {
                    $model_email = ResetPassword::where('email', '=', $email)->first();
                    $model_token = ResetPassword::where('token', '=', $mytoken)->first();
                } catch (\Throwable $th) {
                    return redirect($url)->with('msg', 'Error reset password!');
                }
                
                if($model_email != null){
                    if($model_email == $model_token){
                        try {
                            $user = User::where('email', '=', $email)->first();
                            $user->password = bcrypt($password);
                            $user->save();
                        } catch (\Throwable $th) {
                            return redirect($url)->with('msg', 'Error reset password!');
                        }
                    }
                }

                return redirect('cus')->with('msg', 'Password has reset! Login here!');
                
            break;
            default:
                index();
            break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Func reset password
    public function resetPassword($mytoken = "", $email = ""){

        if(User::resetPassword($mytoken, $email)){
            return view('reset-password', ['email'=> $email, 'mytoken'=>$mytoken]);
        }else{
            return redirect('4040404040404040404040404040404040404040404404040404');
        }        
    }

    //Func send email confirm request reset password
    public function sendMailReset(Request $request){

        $request->validate([
            'email'=>'required'
        ]);

        $email = $request->input('email');
        $mytoken = Str::random(50);
       
        try {
            $model = ResetPassword::where('email', '=', $email)->delete();
            
            ResetPassword::insert([
                'email' => $email,
                'token' => $mytoken,
                'created_at'=>now()
            ]);
        } catch (\Throwable $th) {
            return redirect('cus')->with('msg', 'Error reset password!');
        }

        $user_ = User::where('email', $email)->first();

        try {
            Mail::to($email)->send(new ResetPasswordMail($user_->name, $mytoken, $email));
        } catch (\Throwable $th) {
            return redirect('cus')->with('msg', 'Error reset password!');
        }
        
        return redirect('cus')->with('msg', 'Success send mail reset password!');
        
    }

    // Function Confirm Password from email!
    public function confirmEmail($mytoken = "", $id = ""){

        if(strlen($mytoken) != 50 || strlen($id) == 0){
            return redirect('cus/register');
        }

        try {
            $user_token = User::where('remember_token', $mytoken)->first();
            $user_id    = User::where('id', $id)->first();
            
            if($user_token == $user_id){
                $user_token->email_verified_at = now();
                $user_token->save();  
            }
            else{
                return redirect('cus/register')->with('msg', 'Error verified email!');
            }
        } catch (\Throwable $th) {
            return redirect('cus/register')->with('msg', 'Error verified email!');
        }

        return redirect('cus')->with('msg', 'Account has verified. Login here!');
    }

    public function logoutAccount(){
        Auth::logout(); 
        return redirect('cus');
    }

    public function pageLogin(Request $request){

        $username = $request->cookie('username');
        $password = $request->cookie('password');
        $remember = $request->cookie('remember');

        return view('login', ['username'=>$username, 'password'=>$password, 'remember'=>$remember]);
    }

    public function pageRegister(){
        return view('register');
    }

    public function pageProfile(){
        return view('profile', ['user'=>Auth::user()]);
    }
}
