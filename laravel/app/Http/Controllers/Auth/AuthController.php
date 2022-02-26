<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PostUserRequest;
use App\Http\Requests\Postsigninrequest;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function getsignup(){
        return view('auth.signup');
    }
    public function postsignup(PostUserRequest $request){
       if(!User::create([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        ])){
            return back()->withdanger('user not created');
        }
        return back()->withsuccess($request->first_name.' created successfully');
        
    }
    public function getsignin(){
        return view('auth.signin');
    }
    public function postsignin(Request $request){
        $this->validate($request,[
            'email'=>'required|max:100',
            'password'=>'required|min:6',
        ]);
    if(!Auth::attempt($request->only(['email','password']),$request->has('remember'))){
   return back()->withinfo('could not sign you in with those details');
    }
   // dd("ff");
    return redirect()->route('home')->withsuccess('you have successfully logged in');
    }
    public function signout(){
        Auth::logout();
        return redirect()->route('home')->withdanger('you are signed out');

    }
    public function redirecttogoogle(){
        //send the usser request to github
          return Socialite::driver('google')->redirect();
    }
    public function handlegooglecallback(){
        //get auth request back from github
        try{
            $user=Socialite::driver('google')->stateless()->user();
        }catch (Exception $e){
            return redirect('login/google');
        }

      $authuser=$this->createUser($user);
      Auth::login($authuser,true);
      return redirect()->route('frontend.index')->withsuccess("logged in successfully");
    }
    public function createuser($user){
        $authuser=User::where('google_id',$user->id)->first();
        if($authuser){
            return $authuser;
        }
        return User::create(
            [
                'first_name'=>$user->name,
                'google_id'=>$user->id,
                'email'=>$user->email,
                'status'=>1,
              //  'avatar'=>$user->avatar,

            ]
        );
    }
}
