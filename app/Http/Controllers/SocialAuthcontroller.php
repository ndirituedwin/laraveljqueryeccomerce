<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\Models\SocialAccounts;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthcontroller extends Controller
{
    public function googleredirect(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googlecallback(SocialAccounts  $service){
        $user=$service->findOrCreate(Socialite::driver('google')->stateless()->user());
        auth()->login($user);
        return redirect('login/google')->back()->withsuccess("logged in successfully");

    }
}
