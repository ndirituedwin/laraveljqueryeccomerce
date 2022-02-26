<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class BannersController extends Controller
{
    public function getbanners(){
       // dd(ShippingCharge::all());
        Session::put('page','banners');
        $allbanners=Banner::all()->toArray();
        return view('admin.banners.getbanners')->withbanners($allbanners);
    }
    public function deletebanner($id){
        Banner::where('id',$id)->delete();
        return back()->withsuccess('banner  trashed');
  
    }
    public function updatebannerstatus(Request $request){
        if($request->ajax()){
            //  echo"<prev>";print_r($request->status);die;
              if($request->status=="Active"){
                  $status=0;
              }else{
                  $status=1;
              }
              Banner::where('id',$request->banner_id)->update(['status'=>$status]);
              return response()->json(['status'=>$status,'banner_id'=>$request['banner_id']]);
      
          }
    }
    public function getaddbanner(){
        return view('admin.banners.getaddbanner');
    }
    public function postbanner(Request $request){
        $this->validate($request,[
            'title'=>'unique:banners|required:max:200',
            //'slug'=>'required',
            'alt'=>'required|string',
            'image'=>'nullable|image|max:1999',
            'link'=>'nullable',
           ]);
           //dd($request);
           $image=$request->file('image');
           if ($request->hasFile('image')) {
               $filenamexactt=$request->file('image')->getClientOriginalName();
               $filename=pathinfo($filenamexactt, PATHINFO_FILENAME);
                  $filenameext=$request->file('image')->getClientOriginalExtension();
                   $filenametostore=$filename.'.'.time().'.'.$filenameext;
                   $small='frontend/themes/banner_images/'.$filenametostore;
                   Image::make($image)->resize(200, 350)->save($small);
                 
                   $productimage=$filenametostore;

           }else {
            $productimage="";
        }
       // dd($request);


       Banner::create([
           'image'=>$productimage,
           'title'=>$request['title'],
           'slug'=>Str::slug($request['title']),
           'alt'=>$request['alt'],
           'link'=>$request['link'],
           'status'=>1,
       ]);
       return redirect()->route('admin.banners')->withsucess('banner saved');
    }
    public function editbanner($id){
       // dd($id);
        $banner=Banner::find($id)->toArray();
       // dd($banner);
        return view('admin.banners.geteditbanner')->withbanner($banner);
    }
    public function posteditbanner(Request $request, $id){
 //  dd($request);

   $this->validate($request,[
    'title'=>'required|:max:200',
    //'slug'=>'required',
    'image'=>'nullable|image|max:1999',
    'alt'=>'required|string',
    'link'=>'nullable',
   ]);
   
  // $xistsbanner=Banner::where(['title'=>$request->title,'id','!='=>$id])->first();

   $bannerexists=Banner::where('title',$request->title)->where('id','!=',$id)->get()->toArray();
  // dd($bannerexists);
   if($bannerexists){
       return back()->withdanger('that title has already been taken');
   }
     
   

   $image=$request->file('image');
   if ($request->hasFile('image')) {
       $filenamexactt=$request->file('image')->getClientOriginalName();
       $filename=pathinfo($filenamexactt, PATHINFO_FILENAME);
          $filenameext=$request->file('image')->getClientOriginalExtension();
           $filenametostore=$filename.'.'.time().'.'.$filenameext;
           $small='frontend/themes/banner_images/'.$filenametostore;
           Image::make($image)->resize(200, 350)->save($small);
           Banner::where('id', $id)->update(['image'=>$filenametostore]);
   }
   Banner::where('id',$id)->update([
       'title'=>$request['title'],
       'slug'=>Str::slug($request['title']),
       'alt'=>$request['alt'],
       'link'=>$request['link'],
       'status'=>1,
   ]);
   return redirect()->route('admin.banners')->withinfo('banner updated');
    }
   public function deletebannerimage($id){
    $bannerimage=Banner::select('image')->where('id', $id)->first();
   // dd($bannerimage['image']);
    $imagepathsmall='frontend/themes/banner_images/';
    //delete category image from category image folder
   // dd($imagepathsmall);
    if (file_exists($imagepathsmall.$bannerimage['image'])) {
       // dd($imagepathsmall.$bannerimage['image']);
        unlink($imagepathsmall.$bannerimage['image']);
    }
    
    Banner::where('id', $id)->update(
        [
        'image'=>'',
    ]
    );
    return back()->withdanger('banner image deleted');
   }
}
