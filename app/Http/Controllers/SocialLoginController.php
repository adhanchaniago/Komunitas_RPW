<?php

namespace App\Http\Controllers;

use Socialite;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SocialLoginController extends Controller {
	public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

	public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        // return dd($user);
        return redirect('/');
    }

    public function findOrCreateUser($user, $provider) {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        else{
            $username = explode('@',$user->email);
            $data = User::create([
                'provider_id' => $user->id,
                'name'     => $user->name,
                'username' => $username[0],
                'role' => 'member',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(Str::random(10)),
                'email'    => !empty($user->email) ? $user->email : '' ,
                'avatar' => 'avatars/1.png',
                'provider' => $provider,
            ]);
            return $data;
        }
    }
}
