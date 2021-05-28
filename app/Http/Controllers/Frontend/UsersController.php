<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Sms;
use App\Models\Cart;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PostUserRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function getregisteruser()
    {
        $getsections=Section::with('categories')->where('status', 1)->get();


        return view('Frontend.Auth.getlogin')->withsections($getsections);
    }
    public function postregisteruser(PostUserRequest $request)
    {
        // dd($request);
        User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'status'=>0,
            ]);
        //send activation link to the user
        $email=$request->email;
        $messagedata=[
                'email'=>$request->email,
                'name'=>$request->first_name,
                'code'=>base64_encode($request->email),
            ];
        Mail::send('Frontend.emails.confirmationemail', $messagedata, function ($message) use ($email) {
            $message->to($email)->subject('confirm your eccommerce account');
        });
        return back()->withsuccess('please confirm your email to activate your account');
        /* $message="Dear customer thanks for registering to our website";
         $mobile=$request->mobile;
           if(Sms::sendsms($message,$mobile)){
               dd("sms sent");
           }
           //dd("sms not sent");*/
            /*  $email=$request->email;
              $messagedata=['name'=>$request->first_name,'mobile'=>$request->mobile,'email'=>$request->email];
              Mail::send('Frontend.emails.registeremail',$messagedata,function($message) use($email){
                  $message->to($email)->subject('welcome to  eccomerce websited');
              });
              */
         /*  if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
                return redirect()->route('client.getlogin')->withsuccess('you can now login to your account');

            }*/
       /*  if(!Auth::attempt($request->only(['email','password']))){
              abort(404);
          }*/
        // return back()->withinfo('you can now login to your account,check your email for a register email sent');
          //return redirect()->route('client.getlogin')->withsuccess('you can now login to your account');
 //           return back()->withsuccess($request->first_name.' created successfully');
    }
    public function clientlogout()
    {
        Auth::logout();
        return redirect()->route('frontend.index')->withdanger('you are signed out');
    }
    public function getloginuser()
    {
        $getsections=Section::with('categories')->where('status', 1)->get();
        return view('Frontend.Auth.login')->withsections($getsections);
    }
    public function postloginuser(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email|max:100',
            'password'=>'required|min:6',
        ]);
        if (!Auth::attempt($request->only(['email','password']), $request->has('remember'))) {
            return back()->withinfo('could not sign you in with those details');
        }
        $userstatus=User::Where('email', $request->email)->first();
        $status=$userstatus->status;
        if ($status==0) {
            Auth::logout();
            return redirect()->route('auth.registeruser')->withdanger('please confirm your email to activate');
        }
        if (!empty(Session::get('session_id'))) {
            $user_id=Auth::user()->id;
            $session_id=Session::get('session_id');
            Cart::where('session_id', $session_id)->update([
                    'user_id'=>$user_id,
                ]);
        }
        // return redirect('/getcart');
        // dd("ff");
        return redirect()->route('frontend.index')->withsuccess('you have successfully logged in');
    }
    public function checkcurrentpassword(Request $request)
    {
        if ($request->ajax()) {
            $data=$request->all();
            //      echo"<pre>";print_r($data);die;
            $useremail=User::where('email', $data['email'])->first();
            if (!$useremail) {
                return false;
            } else {
                if (!Hash::check($request['password'], $useremail->password)) {
                    return false;
                }
                return true;
            }
        }
        //   $request->password();
          // print_r($request->password);
          // echo "<prev>";print_r(Auth::guard('admin')->user()->password);die;
    }
    public function checkconfirmpasswords(Request $request)
    {
        if ($request->ajax()) {
            $data=$request->all();
            // echo"<pre>";print_r($data['password_confirmation']);die;
            if ($request->password_confirmation !==$request->password) {
                return false;
            }
            return true;
        }
        //  echo "<prev>";print_r($request->password);die;
    }
    public function checkemail(Request $request)
    {
        if ($request->ajax()) {
            $data=$request->all();
            // echo"<pre>";print_r($data['email']);die;
            $emailexist=User::where('email', $data['email'])->count();
            if ($emailexist>0) {
                return false;
            }
            return true;
        }
    }
    public function checkphonenumber(Request $request)
    {
        if ($request->ajax()) {
            $data=$request->all();
            //echo"<pre>";print_r($data['phone']);die;
            $phoneexist=User::where('mobile', $data['phone'])->first();
            if ($phoneexist) {
                return false;
            }
            return true;
        }
    }
    public function checkemailclient(Request $request)
    {
        if ($request->ajax()) {
            $data=$request->all();
            //  echo "<pre>";print_r($data['email']);die;
            if (!User::where('email', $data['email'])->first()) {
                return false;
            } else {
                return true;
            }
        }
    }
    public function activateaccount($code)
    {
        $email=base64_decode($code);
        //  dd($email);
        $emailexists=User::where('email', $email)->count();
        if ($emailexists>0) {
            $userstatus=User::where('email', $email)->first();
            if ($userstatus->status==1) {
                return redirect()->route('auth.registeruser')->withinfo('your email account isa already activated');
            } else {
                //  dd($userstatus->status);

                //update userstatus
                User::where('email', $email)->update([
                    'status'=>1,
                ]);

                $email=$userstatus->email;
                $messagedata=[
                    'email'=>$userstatus->email,
                    'mobile'=>$userstatus->mobile,
                    'name'=>$userstatus->first_name,
                    'code'=>base64_encode($userstatus->email),
                ];
                Mail::send('Frontend.emails.welcome', $messagedata, function ($message) use ($email) {
                    $message->to($email)->subject('confirm your eccommerce account');
                });
                return redirect()->route('auth.registeruser')->withsuccess('account activated successfully,login now!');
            }
        } else {
            abort(404);
        }
    }
    public function forgotpassword()
    {
        $getsections=Section::with('categories')->where('status', 1)->get();
        return view('Frontend.Auth.forgotpassword')->withsections($getsections);
    }
    public function forgotpasswordpost(Request $request)
    {
        //dd($request->email);
        $this->validate($request, [
             'email'=>'email|required|',
         ]);
        $mailcount=User::where('email', $request->email)->first();
        if ($mailcount) {
            //generate new password
            $randompassword=Str::random(8);
            //dd($randompassword);
            $newpassword=bcrypt($randompassword);
            User::where('email', $request->email)->update(['password'=>$newpassword]);
            $username=User::select('first_name')->where('email', $request->email)->first();
            $email=$request->email;
            $name=$username->first_name;
            $messagedata=[
                  'name'=>$name,
                  'email'=>$email,
                  'password'=>$randompassword,
              ];
            Mail::send('Frontend.Auth.forgotpassswordemail', $messagedata, function ($message) use ($email) {
                $message->to($email)->subject('New password');
            });
            return back()->withinfo('please check your email for a new password');
        
            return back()->withsuccess("password updated successfully");
        }
        return back()->withdanger("That email does not exist");
    }

    public function useraccount()
    {
        $getsections=Section::with('categories')->where('status', 1)->get();
        $countries=Country::where('status', 1)->get()->toArray();
        return view('Frontend.Auth.Useraccount.useraccount')->withcountries($countries)->withsections($getsections);
    }
    public function postuseraccount(Request $request)
    {
        $this->validate($request, [
               'first_name'=>'required|alpha|max:100',
               'email'=>'required|email',
               'last_name'=>'required|alpha|max:100',
               'mobile'=>'required|numeric',
               'address'=>'required',
               'state'=>'required',
               'city'=>'required',
               'country'=>'required',
               'pincode'=>'required',
           ]);
        //   dd("all ok");
        Auth::user()->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'state'=>$request->state,
            'city'=>$request->city,
            'country_id'=>$request->country,
            'pincode'=>$request->pincode,
           ]);
        return back()->withsuccess('data successfully updated');
    }
    public function check(Request $request)
    {
        if (!Hash::check($request->currentpassword, Auth::user()->password)) {
            return false;
        }
        return true;
    }
    public function checkcofirmpasswords(Request $request)
    {

         //echo "<prev>";print_r($request->confirmpassword);die;
        if ($request->confirmpassword !==$request->password) {
            return false;
        }
        return true;
    }
    public function updatepasswordclient(Request $request){
        $this->validate($request,[
            'currentpassword'=>'required|min:6',
            'newpassword'=>'required:confirmed|min:6',
        ]);
        if(!Hash::check($request->currentpassword, Auth::user()->password)){
            return back()->withdanger('Current password is not corrrect');
        }
        if($request->confirmpassword !==$request->newpassword){
            return back()->withdanger('passwords do not match');

        }
        Auth::user()->update(['password'=>bcrypt($request->newpassword)]);
        return back()->withsuccess('password successfully updated');
    }
}