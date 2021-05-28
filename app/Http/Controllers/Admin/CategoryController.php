<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Addcategoryrequest;
use App\Http\Requests\categoryposteditrequest;
use App\Http\Requests\Postcategoryrequest;

class CategoryController extends Controller
{
    public function getcategories(){
     //   dd(json_decode(json_encode(Category::all())));
     Session::put('page','categories');
     $category=Category::with(['section','parentcategory'])->get();
   //  $category=json_decode(json_encode($category),true);
   // echo "<pre>";print_r($category);die;
    // $category=DB::select('EXEC spfetchcategories');
        return  view('admin.category.categories')->withcategories($category);

    }
    public function categoriesstatus(Request $request){
        if($request->ajax()){
      //  echo"<prev>";print_r($request->status);die;
        if($request->status=="Active"){
            $status=0;
        }else{
            $status=1;
        }
        Category::where('id',$request->category_id)->update(['status'=>$status]);
        return response()->json(['status'=>$status,'category_id'=>$request['category_id']]);

    }
   
}
 public function getaddcategory(){
     $getsections=Section::all();
        return view('admin.category.addcategory')->withsections($getsections);
    }
    public function addcategory(Postcategoryrequest $request){
       if($request->hasFile('categoryimage')){
         $filenameext=$request->file('categoryimage')->getClientOriginalName();
          $filename=pathinfo($filenameext,PATHINFO_FILENAME);
                $filenameext=$request->file('categoryimage')->getClientOriginalExtension();
      
            $filenametostore=$filename.'.'.time().'.'.$filenameext;
            $path=$request->file('categoryimage')->move('adminlte/adminimages/images/admincategories',$filenametostore);
          $categoryimage=$filenametostore;
        }else{
          $categoryimage="";
        }

        Category::create([
            'parent_id'=>$request->parent,
            'section_id'=>$request->sections,
            'categoryname'=>$request->categoryname,
            'slug'=>Str::slug($request->categoryname),
           'categoryimage'=>$categoryimage,
            'categorydiscount'=>$request->categorydiscount,
            'description'=>$request->categorydescription,
            'url'=>$request->categoryurl,
            'metatitle'=>$request->metatitle,
            'metadescription'=>$request->metadescription,
            'metakeywords'=>$request->metakeyword,            
            'status'=>1,            
        ]);
        return redirect()->route('admin.categories')->withsuccess('category saved');
    }
    public function updateadmincategories(Request $request){
        if($request->ajax()){
            $data=$request->all();
     //   echo"<pre>";print_r($data);die;
            $getcategories=array();
            $getcategories=Category::with('subcategories')->Where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $getcategories=json_decode(json_encode($getcategories),true);
           // echo"<pre>";print_r($getcategories);die;
             return view('admin.category.appendcategorylevels')->withgetcategories($getcategories);
        }
     
    }
    public function geteditcategory($id){
    //dd($slug);
    $categories=array();
    $getcats=array();
      $categories=Category::where('id',$id)->first();
      $categories=json_decode(json_encode($categories),true);
      // dd($categories);
      $getcats=Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categories['section_id']])->get();
     $getcats=json_decode(json_encode($getcats));
  //  dd($getcats);
      return view('admin.category.geteditcategory')
        ->withcategoriesedit($categories)
        ->withcategoris($getcats)
        ->withsections(Section::all());

    }
    public function posteditcategory(categoryposteditrequest $request, $id){
       // dd($id);

       $categoryexists=Category::where('categoryname',$request->categoryname)->where('id','!=',$id)->get()->toArray();
       if($categoryexists){
           return back()->withdanger('that category has already been taken');
       }
        if($request->hasFile('categoryimage')){
          // dd($request->image);
           $filenameext=$request->file('categoryimage')->getClientOriginalName();
           //dd($filenamewithext);
            $filename=pathinfo($filenameext,PATHINFO_FILENAME);
           // dd($filename);
            //get just ext
              $filenameext=$request->file('categoryimage')->getClientOriginalExtension();
            //  dd($filenameext);
  
              //filenmae to store
              $filenametostore=$filename.'.'.time().'.'.$filenameext;
              $path=$request->file('categoryimage')->move('adminlte/adminimages/images/admincategories',$filenametostore);
            //dd($path);
          //  $categoryimage=$filenametostore;
            Category::where('id', $id)->update(['categoryimage'=>$filenametostore]);
              
         /* }else{
            $categoryimage="";
        */  }
        Category::where('id',$id)->update([
          'parent_id'=>$request->parent,
          'section_id'=>$request->sections,
          'categoryname'=>$request->categoryname,
          'slug'=>Str::slug($request->categoryname),
        // 'categoryimage'=>$categoryimage,
          'categorydiscount'=>$request->categorydiscount,
          'description'=>$request->categorydescription,
          'url'=>$request->categoryurl,
          'metatitle'=>$request->metatitle,
          'metadescription'=>$request->metadescription,
          'metakeywords'=>$request->metakeyword,            
          'status'=>1,            
        ]); 
        return redirect()->route('admin.categories')->withsuccess('category updated');
    }
    public function deletecategoryimage($id){
      $categoryimage=Category::select('categoryimage')->where('id',$id)->first();
   $imagepath='adminlte/adminimages/images/admincategories/';

   //delete category image from category image folder
     if(file_exists($imagepath.$categoryimage->categoryimage)){
       //dd($imagepath.$categoryimage->categoryimage);
       unlink($imagepath.$categoryimage->categoryimage);
     }
     //delete category image from categories table
     Category::where('id',$id)->update([
       'categoryimage'=>"",
     ]);
     return back()->withsuccess('category image deleted');

    }
    public function deletecategory($id)
    {
    //  dd($id);
      Category::where('id',$id)->delete();
      return back()->withsuccess('category  trashed');

    }
}
