<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function getcoupons(){
        Session::put('page','coupons');

        $coupons=Coupon::all()->toArray();
        return view('admin.coupons.getcoupons')->withcoupons($coupons);
    }
    public function getaddcoupon(){
        $sectioncategories=Section::with('categories')->get();
        //users
        $users=User::select('email')->where('status',1)->get()->toArray();
      return view('admin.coupons.getaddcoupon')->withcategoriess($sectioncategories)->withusers($users);
    }
    public function postaddcoupon(Request $request){
   //    dd($request);
     $this->validate($request,[
         'couponoption'=>'required',
         'coupontype'=>'required',
         'couponcode'=>'nullable',
         'amounttype'=>'required',
         'categories'=>'required',
         'users'=>'nullable',
         'amount'=>'required',
         'expirydate'=>'required',

     ]);
        if(isset($request['users'])){
            $users=implode(',',$request['users']);
        }
        if(isset($request['categories'])){
            $categories=implode(',',$request['categories']);
        }
        if($request['couponoption']=="Automatic"){
            $couponcode=str_random(8);
        }else{
            $couponcode=$request['couponcode'];
        }
      //  dd($request);
        Coupon::create([
            'couponoption'=>$request['couponoption'],
            'couponcode'=>$couponcode,
            'categories'=>$categories,
            'users'=>$users,
            'coupontype'=>$request['coupontype'],
            'amounttype'=>$request['amounttype'],
            'amount'=>$request['amount'],
            'expirydate'=>$request['expirydate'],
            'status'=>1,
        ]);
        return redirect()->route('admin.coupons')->withsuccess('coupon successfully saved');
    }
    public function editcoupon($id){
        $findcoup=Coupon::find($id);
        $sectioncategories=Section::with('categories')->get()->toArray();
        $users=User::select('email')->where('status',1)->get()->toArray();
        $selectcats=explode(',',$findcoup['categories']);
        $selectusers=explode(',',$findcoup['users']);
         return view('admin.coupons.editcoupon')
        ->withcoupon($findcoup)
        ->withusers($users)
        ->withcategoriess($sectioncategories)
        ->withselectcats($selectcats)
        ->withselectusers($selectusers);
    }
    public function posteditcoupon(Request $request,$id){
        $this->validate($request,[
            'couponoption'=>'required',
            'coupontype'=>'required',
            'couponcode'=>'nullable',
            'amounttype'=>'required',
            'categories'=>'required',
            'users'=>'nullable',
            'amount'=>'required',
            'expirydate'=>'required',
   
        ]);
        if(isset($request['users'])){
            $users=implode(',',$request['users']);
        }
        if(isset($request['categories'])){
            $categories=implode(',',$request['categories']);
        }
        if($request['couponoption']=="Automatic"){
            $couponcode=str_random(8);
        }else{
            $couponcode=$request['couponcode'];
        }
        Coupon::where('id',$id)->update([
            'couponoption'=>$request['couponoption'],
            'couponcode'=>$couponcode,
            'categories'=>$categories,
            'users'=>$users,
            'coupontype'=>$request['coupontype'],
            'amounttype'=>$request['amounttype'],
            'amount'=>$request['amount'],
            'expirydate'=>$request['expirydate'],
            'status'=>1,
        ]);
        return redirect()->route('admin.coupons')->withsuccess('coupon successfully updated');

    }
    public function updatecoupontatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
       //  echo"<prev>";print_r($request->coupon_id);die;
              if($request->status=="Active"){
                  $status=0;
              }else{
                  $status=1;
              }
              Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
              return response()->json(['status'=>$status,'coupon_id'=>$request['coupon_id']]);
      
          }
    }
    public function deletecoupon($id){
        Coupon::where('id',$id)->delete();
        return back()->withsuccess('coupon  trashed');
  
    }
    
}
