<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $fb = new Facebook([
            'app_id' => config('services.facebook.app_id'),
            'app_secret' => config('services.facebook.app_secret'),
        ]);
        try {
            $response = $fb->get('/me?fields=id,name,email,link,birthday', $facebook['access_token']); 
            $profile = $response->getGraphUser();
            if (!$profile || !isset($profile['id'])) { 
                return $this->responseErrors(config('code.user.login_facebook_failed'), trans('messages.user.login_facebook_failed'));
            }
    
            $email = $profile['email'] ?? null;
            $social = SocialAccount::where('provider_user_id', $profile['id'])->where('provider', 'facebook')->first();
            if ($social) {
                $user = $social->user;
            } else {
                $user = new User();
                $user->password = bcrypt($profile['name']);
                $user->email = $profile['email'];
                $user->name = $profile['name'];
                $user->save();
                $user->socialNetwork()->create([
                    'provider_user_id' => $data->id,
                    'provider' => 'google',
                ]);
            }
    
            $user->assignRole(config('settings.roles.customer'));
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
    
            return response()->json([
                'status'=>1,
                'msg'=>'Login success',
                'data'=>[
                    'token'=>$token,
                    'user'=>new UserResource($user)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error when login with google ' . $e 
            ]);
        }
    }

    public function loginGoogle(Request $request)
    {
        $access_token = $request->get('access_token');
        if (!$access_token) {
            return response()->json([
                'status'=>0,
                'msg'=>'access token is require',
            ]);
        }

        try {
            
            $client = new Client();
            $body = $client->get(Config('api.url_endpoint_infoGoogle') . $access_token)->getBody(); 
            $data = json_decode($body->getContents());

            $social = SocialAccount::where('provider_user_id', $data->id)->where('provider', 'google')->first();
            if ($social) {
                $user = $social->user;
            } else {
                $user = new User();
                $user->email = $data->email;
                $user->name = $data->name;
                $user->password = bcrypt($data->name);
                $user->save();
                $user->socialNetwork()->create([
                    'provider_user_id' => $data->id,
                    'provider' => 'google',
                ]);
                $user->profile()->create([
                    'avatar'=>$data->picture
                ]);
                $user->assignRole(config('settings.roles.customer'));
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;

            return response()->json([
                'status'=>1,
                'msg'=>'Login success',
                'data'=>[
                    'token'=>$token,
                    'user'=>new UserResource($user)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error when login with google ' . $e 
            ]);
        }
    }
}
