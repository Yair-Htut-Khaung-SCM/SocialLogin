<?php

namespace App\Http\Controllers;

use App\Enums\Provider;
use App\Models\User;
use App\Models\ProviderInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialiteAuthController extends Controller
{
    public function redirect(Provider $provider)
    {

        return Socialite::driver($provider->value)->redirect();
    }


    public function authenticate(Provider $provider)
    {

        try {

            $socialiteUser = Socialite::driver($provider->value)->user();

            $providerName = $provider->value;
            $providerUserId = $socialiteUser->getId();

            $user_id = ProviderInformation::where('provider_name', $providerName)
            ->where('provider_user_id', $providerUserId)
            ->pluck('user_id')
            ->first();

            if($user_id) {
                $user = User::find($user_id);
                $user->name = $socialiteUser->name;
                $user->email = ($socialiteUser->email) ? ($socialiteUser->email) : '';
                $user->provider_user_id = $providerUserId;
                $user->provider_name = $providerName;
                $providerInfo = ProviderInformation::where([
                    'provider_name' => $providerName,
                    'provider_user_id' => $providerUserId,
                ])->first();
                $providerInfo->provider_name = $provider->value;
                $providerInfo->provider_user_name = $socialiteUser->name;
                $providerInfo->provider_user_email = $socialiteUser->email;
                $providerInfo->provider_user_picture = $socialiteUser->avatar;
                $providerInfo->access_token = $socialiteUser->token;
                $providerInfo->refresh_token = $socialiteUser->refreshToken;
                $providerInfo->save();


                $user->save();
            } else {

                $user = User::create([
                    'name' => $socialiteUser->name,
                    'provider_user_id' => $providerUserId,
                    'provider_name' => $providerName,
                    'email' => ($socialiteUser->email) ? ($socialiteUser->email) : '',
                    'password' => Hash::make(time()),
                ]);
                ProviderInformation::create([
                    'provider_name' => $providerName,
                    'user_id'   => $user->id,
                    'provider_user_id' => $providerUserId,
                    'provider_user_name' => $socialiteUser->name,
                    'provider_user_email' => ($socialiteUser->email) ? ($socialiteUser->email) : '',
                    'provider_user_picture' => $socialiteUser->avatar,
                    'access_token' => $socialiteUser->token,
                    'refresh_token' => $socialiteUser->refreshToken,
                ]);

            }

            Auth::login($user);
            $providerInfo = ProviderInformation::where([
                'provider_name' => $providerName,
                'provider_user_id' => $providerUserId,
            ])->first();

            return view('home')->with(['providerInfo' => $providerInfo]);

        } catch (\Exception $exception) {
            \Log::info($exception);
            return to_route('login');
        }
    }
}
