<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LineLoginController extends Controller
{
    public function lineLogin()
    {
        $state = Str::random(32);
        $nonce  = Str::random(32);

        $uri = "https://access.line.me/oauth2/v2.1/authorize?";
        $response_type = "response_type=code";
        $client_id = "&client_id=" . config('services.line.client_id');
        $redirect_uri = "&redirect_uri=" . config('services.line.redirect');
        $state_uri = "&state=" . $state;
        $scope = "&scope=openid%20profile";
        $prompt = "&prompt=consent";
        $nonce_uri = "&nonce=";
        $bot_prompt = "&bot_prompt=normal";

        $uri = $uri . $response_type . $client_id . $redirect_uri . $state_uri . $bot_prompt . $scope . $prompt . $nonce_uri;

        return redirect($uri);
    }

    public function getAccessToken($req)
    {

        $headers = ['Content-Type: application/x-www-form-urlencoded'];
        $post_data = array(
            'grant_type'    => 'authorization_code',
            'code'          => $req['code'],
            'redirect_uri'  => config('services.line.redirect'),
            'client_id'     =>  config('services.line.client_id'),
            'client_secret' => config('services.line.client_secret'),
        );
        $url = 'https://api.line.me/oauth2/v2.1/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $res = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($res);
        $accessToken = $json->access_token;

        return $accessToken;
    }

    public function getProfile($at)
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $at));
        curl_setopt($curl, CURLOPT_URL, 'https://api.line.me/v2/profile');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res);

        return $json;
    }

    public function callback(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, 'error')) {
            return redirect('/');
        };
        $accessToken = $this->getAccessToken($request);
        $profile = $this->getProfile($accessToken);

        $user = User::where('line_id', $profile->userId)->first();

        if ($user) {
            Auth::login($user);
            return redirect('/');
        } else {
            $user = new User();
            $user->line_id = $profile->userId;
            $user->name = $profile->displayName;
            $user->email_verified_at =  date("Y-m-d H:i:s");
            $user->code = Hash::make(rand(0, 100));
            $user->save();
            Auth::login($user, true);
            return redirect('/');
        }
    }
}
