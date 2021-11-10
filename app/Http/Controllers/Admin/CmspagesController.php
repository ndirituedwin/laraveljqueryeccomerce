<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cmspage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CmspagesController extends Controller
{
    public function cmspages(){
        Session::put('page', 'cmspages');
        $cmspages=Cmspage::all();
            return view('admin.Cmspages.cmspages')->withcmspages($cmspages);
    }
    public function updatecmspage(Request $request,$id=null){
        if($id==""){
            $title="Add Cmspage";
            $cmspage=new Cmspage();
            $message="Cmspage added successfully";
        }else{
            $title="Edit Cmspage";
             $cmspage=Cmspage::find($id);
             $message="Cmspage updated successfully";

        }
        if($request->isMethod('post')){
            $this->validate($request,[
                // 'title'=>'required|string|unique:cmspages',
                'description'=>'required|string',
                'meta_title'=>'required|string',
                'meta_description'=>'required|string',
                'meta_keyword'=>'required|string',

            ]);
            $data=$request->all();
            $cmspage->admin_id=Auth::guard('admin')->user()->id;
            $cmspage->title=$data['title'];
            // $cmspage->slug=Str::slug($data['title']);
            $cmspage->description=$data['description'];
            $cmspage->meta_title=$data['meta_title'];
            $cmspage->meta_description=$data['meta_description'];
            $cmspage->meta_keyword=$data['meta_keyword'];
            $cmspage->status=1;
            $cmspage->save();
            Session::flash('success_message',$message);
            return redirect()->route('admin.cmspages');
        }
     return view('admin.Cmspages.addeditcmspage')
     ->withcmspage($cmspage)
     ->withtitle($title)
     ->withmessage($message);
    }
    public function cmspagesedit($cmspage){
        dd($cmspage);
    }

    public function updatecmspagestatus(Request $request){
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            Cmspage::where('id', $request->cmspage_id)->update(['status'=>$status]);
            return response()->json(['status'=>$status,'cmspage_id'=>$request['cmspage_id']]);
        }
    }
    public function cmspagedelete($id){
        Cmspage::where('id',$id)->delete();
        return back()->withsuccess('brand deleted');
    }

}
