<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\SocialLogin;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;

class SocialLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('auth.social');
    }

    /**
     * Redirects to service provider.
     *
     * @param string provider
     * @return request
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handling a callback from a service provider.
     * Creating a new social user or getting an exist.
     *
     * @param Request request
     * @param string provider
     * @return request
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        // Checking for a request errors
        if (isset($request->error))
            if ($request->error === 'access_denied')
                return redirect('/register')->withErrors(['header' => 'You did not shared your profile.']);

        $socialiteUser = Socialite::with($provider)->user();      
        // Trying to get a current social user.
        $user = $this->getFromSocialite($socialiteUser, $provider);

        if ($user==null) {
            // Checking if exists user with current email.
            $checkEmail = User::where('email' , $socialiteUser->getEmail())->first();
            if ($checkEmail!=null)               
                return redirect('/register')->withErrors(['email' => 'The email has already been taken.']);
            // Creating new User form social provider.
            $user = $this->createFromSocialite($socialiteUser, $provider);
        }

        Auth::login($user,true);
        return redirect('/');
    }

    /**
     * 
     */
    private function createFromSocialite($socialiteUser, $provider){
        $user = new User;
        $user->email = $socialiteUser->getEmail();
        $user->name = explode(' ', $socialiteUser->getName())[0];
        $user->social_id = $socialiteUser->getId();
        $user->auth_via = $provider;
        $user->save();
        return $user;
    }

    /**
     * 
     */
    private function getFromSocialite($socialiteUser, $provider){
        $rules = [
            'social_id' => $socialiteUser->getId(),
            'auth_via' => $provider
        ];
        return User::where($rules)->first();
    }
}