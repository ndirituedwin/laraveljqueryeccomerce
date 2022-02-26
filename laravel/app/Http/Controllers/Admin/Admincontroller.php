<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PostUserRequest;
use App\Http\Requests\Postadminrequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Updateadminrequest;
use App\Http\Requests\Updatepasswordrequest;

class Admincontroller extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');

//        $userorders=Order::with('orders_products')->where('orderstatus',"New")->orderBy('id','DESC')->get()->toArray();
$newrorders=Order::with('orders_products')->where('orderstatus',"New")->orderBy('id','DESC')->count();
$cancelledorders=Order::with('orders_products')->where('orderstatus',"Cancelled")->orderBy('id','DESC')->count();
$users=User::count();
       //dd($users);
        //dd($userorders);
        return view('admin.admindashboard')
        ->withusers($users)
        ->withcancelledorders($cancelledorders)
        ->withneworders($newrorders);
    }

    public function getadminlogin(){
        return view('admin.adminlogin');
    }
    public function postadminlogin(Postadminrequest $request){
    // dd($request);
    $data=$request->all();
   // dd($data);

    if(!Auth::guard('admin')->attempt(['email'=>$request['email'],'password'=>$request['password'],'status'=>1],$request->has('remember'))){
        return back()->withdanger('could not sign you in with those details');

    }
  //  dd("rr");

        return redirect()->route('dashboard');
    }
    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->withinfo('successfully loged out');
    }
    public function getadminsettings(){
        Session::put('page','settings');

        return view('admin.adminsettings');
    }

    public function checkcurrentpassword(Request $request){
     //   $request->password();
       // print_r($request->password);
       // echo "<prev>";print_r(Auth::guard('admin')->user()->password);die;
        if(!Hash::check($request->currentpassword,Auth::guard('admin')->user()->password)){
            return false;
        }
        return true;

    }
public function checkconfirmpasswords(Request $request){

   //  echo "<prev>";print_r($request->password);die;
      if($request->password_confirmation !==$request->password){
          return false;
      }
      return true;
}
    public function postadminsettings(Updatepasswordrequest $request){
       if(!Hash::check($request->currentpassword,Auth::guard('admin')->user()->password)){
        return back()->withdanger('password  is incorrect');
       }
      Admin::where('id',Auth::guard('admin')->user()->id)->update([
          'password'=>bcrypt($request->password),
      ]);
      return back()->withsuccess('password updated successfully');

    }
    public function getupdateadmindetails(){
        Session::put('page','updateadmindetails');

        $adminimage=Auth::guard('admin')->user()->image;

        return view('admin.updateadmindetails')->withimages($adminimage);
    }
   public function updateadmindetails(Updateadminrequest $request){
      //  dd($request);

       $moble=Auth::guard('admin')->user()->mobile;
       $id=Auth::guard('admin')->user()->id;
      /* $mobileexist=Admin::where(DB::raw("select*from admins WHERE mobile=$moble AND id  !=$id"));
       if($mobileexist){
           return back()->withdanger('mobile number has already been taken, choose another');
       }
       if($request->mobile){

       }
       dd("go ahead");*/
       if($request->hasFile('image')){
          // dd($request->image);
           $filenameext=$request->file('image')->getClientOriginalName();
           //dd($filenamewithext);
            $filename=pathinfo($filenameext,PATHINFO_FILENAME);
           // dd($filename);
            //get just ext
              $filenameext=$request->file('image')->getClientOriginalExtension();
            //  dd($filenameext);

              //filenmae to store
              $filenametostore=$filename.'.'.time().'.'.$filenameext;
              $path=$request->file('image')->storeAs('public/adminlte/adminimages/images',$filenametostore);
            //dd($path);
              Admin::where('email',Auth::guard('admin')->user()->update(['image'=>$filenametostore]));
            }
      Admin::where('email',Auth::guard('admin')->user()->update([
           'name'=>$request->name,
           'mobile'=>$request->mobile,
       ]));
       return back()->withsuccess('you have updated the profile successfully');
   }
}