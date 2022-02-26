<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;

class brandcontroller extends Controller
{
    public function getallbrands(){
        Session::put('page','brands');
        $brands=Brand::all();
        return view('admin.brands.getallbrands')->withbrands($brands);
    }
    public function updatebrandstatus(Request $request){
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            Brand::where('id', $request->brand_id)->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$request['brand_id']]);
        }
    }
    public function getaddbrand(){
        return view('admin.brands.getaddbrands');
    }
    public function postbrand(Request $request){
         // dd($request);
          $this->validate($request,[
              'brand'=>'required|unique:brands|max:50',
          ]);
         // dd($request);
          Brand::create([
              'brand'=>$request->brand,
              'status'=>1,

          ]);
          return redirect()->route('admin.brands')->withsuccess('brand saved');
    }
    public function geteditbrand($id){
        return view('admin.brands.getposteditbrand')->withbrand(Brand::find($id));
    }
    public function posteditbrand(Request $request, $id){
        //dd($id);
        $this->validate($request,[
            'brand'=>'required|max:50'
        ]);
       
        Brand::where('id',$id)->update([
            'brand'=>$request->brand,
            'status'=>1,
        ]);
        return redirect()->route('admin.brands')->withsuccess('brand saved');
    }
    public function deletebrand($id){
        Brand::where('id',$id)->delete();
        return back()->withsuccess('brand deleted');
    }
}
