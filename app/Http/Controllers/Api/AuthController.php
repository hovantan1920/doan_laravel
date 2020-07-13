<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth; 
use GuzzleHttp\Client;
use Carbon\Carbon;

use App\User;
use App\SocialAccount;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function loginFacebook(Request $request){
        $access_token = $request->get('access_token');
        if(!$access_token){
            return response()->json([
                'status'=>0,
                'msg'=> 'access_token is require'
            ]);
        }

        try {    
            $data = $request->all();
            $social = SocialAccount::where('provider_id', $data->id)->where('provider', 'facebook')->first();
            if ($social) {
                $user = $social->user;
            } else {
                // $user = new User();
                // $user->password = bcrypt($profile['name']);
                // $user->email = $profile['email'];
                // $user->name = $profile['name'];
                // $user->save();
                // $user->socialNetwork()->create([
                //     'provider_user_id' => $data->id,
                //     'provider' => 'google',
                // ]);
            }
    
            // $user->assignRole(config('settings.roles.customer'));
            // $tokenResult = $user->createToken('Personal Access Token');
            // $token = $tokenResult->accessToken;
    
            // return response()->json([
            //     'status'=>1,
            //     'msg'=>'Login success',
            //     'data'=>[
            //         'token'=>$token,
            //         'user'=>new UserResource($user)
            //     ]
            // ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error when login with facebook ' . $e->getMessage() 
            ]);
        }
    }

    public function loginGoogle(Request $request)
    {
        try {
            $social = SocialAccount::where('provider_id', $request->id)->where('provider', 'google')->first();
            if ($social) {
                $user = $social->user;
            } else {
                $user = new User(); 
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = bcrypt($request->id);
                $user->avatar = $request->picture;
                $user->roles_id = (config('settings.roles.customer') ?? 3);
                $user->active = 1;
                $user->save();
                $user->socialNetwork()->create([
                    'provider_id' => $request->id,
                    'provider' => 'google',
                ]);
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;

            return response()->json([
                'status'=>1,
                'msg'=>'Login success',
                'data'=>(new UserResource($user))->pushToken($token)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error when login with google ' . $e ->getMessage()
            ]);
        }
    }
    public function profile(Request $request)
    {
        try {
            $user = Auth::user(); 
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->birthday = $request->birthday ?? $user->birthday;
            $user->gender = $request->gender ?? $user->gender;
            $user->numberphone = $request->numberphone ?? $user->numberphone;
            $user->save();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
            return response()->json([
                'status'=>1,
                'msg'=>'Success',
                'data'=>(new UserResource($user))->pushToken($token)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'error: ' . $e ->getMessage()
            ]);
        }
    }

    public function uploadAvatar(Request $request)
    {
        try {
            $user = Auth::user(); 
            if($request->hasFile('picture')) {
                $allowedfileExtension=['jpg','png'];
                $file = $request->file('picture');
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if($check) {
                    $filename = $file->storeAs('/public/images/avatars', 
                    Carbon::now()->format('d-m-Y') . '-avatar-' . rand(99999,999999999).'.'.$extension);
                    $filename = str_replace("public","storage",$filename);
                    $user->avatar = $filename;
                } else {
                    return response()->json([
                        'status'=>0,
                        'msg'=>'The avatar needs an extension of jpg or png'
                    ]);
                }
            }
            $user->save();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
            return response()->json([
                'status'=>1,
                'msg'=>'Success',
                'data'=>(new UserResource($user))->pushToken($token)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'error: ' . $e ->getMessage()
            ]);
        }
    }
}
