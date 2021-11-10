<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Productimage;
use Illuminate\Http\Request;
use App\Models\Productattribute;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\postproductrequest;
use App\Http\Requests\Posteditproductrequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getallproducts()
    {
        Session::put('page', 'products');
        $products=Product::with(['category'=>function ($query) {
            $query->select('id', 'categoryname')->where('status', 1);
        },'section'=>function ($query) {
            $query->select('id', 'section')->where('status', 1);
        }])->get();

        //$products=json_decode(json_encode($products),true);
        //dd($products);

        return view('admin.product.displayproducts')

        ->withproducts($products);
    }
    public function getaddproducts()
    {
        $fabric=array('cotton','polyster','wool');
        $pattern=array('full sleeve','half sleeve','short sleeve','sleeveless');
        $sleeve=array('checked','plain','printed','self','solid');
        $fit=array('regular','slim');
        $occassion=array('casual','formal');
        $sectioncategories=Section::with('categories')->get();
        //   dd(json_decode(json_encode($sectioncategories)));
        $brands=Brand::where('status',1)->get();
        return view('admin.product.addproduct')
        ->withcategoriess($sectioncategories)
        ->withfabrics($fabric)
        ->withbrands($brands)
        ->withpatterns($pattern)
        ->withsleeves($sleeve)
        ->withfits($fit)
        ->withoccassions($occassion);
    }
    public function addproducts(postproductrequest $request)
    {

      //  dd($request->brand);
   // dd($request);
        $image=$request->file('productimage');
        if ($request->hasFile('productimage')) {
            // dd($request->image);
            $filenamexactt=$request->file('productimage')->getClientOriginalName();
            //dd($filenamewithext);
            $filename=pathinfo($filenamexactt, PATHINFO_FILENAME);
            // dd($filename);
            //get just ext
            $filenameext=$request->file('productimage')->getClientOriginalExtension();
            //  dd($filenameext);
            //filenmae to store
            $filenametostore=$filename.'.'.time().'.'.$filenameext;
            //  $large=$request->file('productimage')->move('adminlte/adminimages/images/adminproducts/large',$filenametostore);
            // $medium=$request->file('productimage')->move('adminlte/adminimages/images/adminproducts/medium',$filenametostore);
            // $small=$request->file('productimage')->move('adminlte/adminimages/images/adminproducts/small',$filenametostore);
            $large='adminlte/adminimages/images/adminproducts/large/'.$filenametostore;
            $medium='adminlte/adminimages/images/adminproducts/medium/'.$filenametostore;
            $small='adminlte/adminimages/images/adminproducts/small/'.$filenametostore;
            Image::make($image)->resize(300, 450)->save($large);
            Image::make($image)->resize(200, 300)->save($medium);
            Image::make($image)->resize(100, 150)->save($small);
            // $path=$request->file('productimage')->move('adminlte/adminimages/images/adminproducts',$filenametostore);
            //dd($path);
            $productimage=$filenametostore;
        } else {
            $productimage="";
        }
        if (!empty($request->featured)) {
            $featured="1";
        }
        $featured=0;

        if(empty($request['productdiscount'])){
            $productdiscount=0.0;
        }
            $productdiscount=$request['productdiscount'];

        $categorydetails=Category::find($request->category);
        Product::create([
           'admin_id'=>Auth::guard('admin')->user()->id,
            'section_id'=>$categorydetails->section_id,
            'category_id'=>$request->category,
            'productname'=>$request->productname,
            'slug'=>Str::slug($request->productname),
            'brand_id'=>$request->brand,
            'productcode'=>$request->productcode,
            'productcolor'=>$request->productcolor,
            'groupcode'=>$request->groupcode,
            'productprice'=>$request->productprice,
            'productdiscount'=>$productdiscount,
            'productweight'=>$request->productweight,
            'productimage'=>$productimage,
            'productdescription'=>$request->productdescription,
            'washcare'=>$request->washcare,
            'fabric'=>$request->fabric,
            'pattern'=>$request->pattern,
            'sleeve'=>$request->sleeve,
            'fit'=>$request->fit,
            'occassion'=>$request->occassion,
            'metattitle'=>$request->metattitle,
            'metadescription'=>$request->metadescription,
            'metakeyword'=>$request->metakeyword,
            'featured'=>$featured,
            'status'=>1,
        ]);
        return redirect()->route('admin.products')->withsuccess('product added successfully');
    }
    public function productstatusupdate(Request $request)
    {
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            Product::where('id', $request->product_id)->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$request['product_id']]);
        }
    }
    public function updateimagestatus(Request $request){
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            Productimage::where('id', $request->image_id)->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$request['image_id']]);
        }
    }
    public function deleteproduct($id)
    {

    }
    public function editproducts($id)
    {
        //   dd($id);
        $product=Product::find($id);
        // dd($product);



        $brands=Brand::where('status',1)->get();


          $productFilters=Product::productFilters();
          $fabric=$productFilters['0'];
          $pattern=$productFilters['2'];
          $sleeve=$productFilters['1'];
          $fit=$productFilters['3'];
          $occassion=$productFilters['4'];
       //   echo"<pre>";print_r($productFilters);
           $sectioncategories=Section::with('categories')->get();

        return view('admin.product.geteditproduct')
        ->withbrands($brands)
    ->withfabrics($fabric)
    ->withpatterns($pattern)
    ->withsleeves($sleeve)
    ->withfits($fit)
    ->withoccassions($occassion)
    ->withcategoriess($sectioncategories)
    ->withproduct($product);
    }
    public function posteditproduct(Posteditproductrequest $request, $id)
    {

        //dd(json_decode(json_encode(Product::all())));
        //dd(Product::where('productname',$request['productname'])->first()->toArray());
        //first check to see if the product already exists befor editing
        $productcount=Product::where('productname',$request['productname'])->where('id','!=',$id)->count();
    //    $productcount=Product::where('productname',$request['productname'])->get()->toArray()/*->where('id','!=',$id)->count()*/;
      //  dd($productcount);
          //if count is greater than zero
      if($productcount>0){
          return back()->withdanger('Product name already exists, choose another name');
      }


      //    dd("you can now add");
          $image=$request->file('productimage');
        if ($request->hasFile('productimage')) {
            $filenamexactt=$request->file('productimage')->getClientOriginalName();
            $filename=pathinfo($filenamexactt, PATHINFO_FILENAME);
               //get just ext
            $filenameext=$request->file('productimage')->getClientOriginalExtension();
            //filenmae to store
            $filenametostore=$filename.'.'.time().'.'.$filenameext;
                      $large='adminlte/adminimages/images/adminproducts/large/'.$filenametostore;
            $medium='adminlte/adminimages/images/adminproducts/medium/'.$filenametostore;
            $small='adminlte/adminimages/images/adminproducts/small/'.$filenametostore;
            Image::make($image)->resize(300, 450)->save($large);
            Image::make($image)->resize(200, 300)->save($medium);
            Image::make($image)->resize(100, 150)->save($small);
                 Product::where('id', $id)->update(['productimage'=>$filenametostore]);
        }


        if (!empty($request->featured)) {
            $featured=1;
        } else {
            $featured=0;
        }

        $categorydetails=Category::find($request->category);
        if(empty($request['productdiscount'])){
            $productdiscount=0;
        }
            $productdiscount=$request->productdiscount;

        Product::Where('id', $id)->update([
         'admin_id'=>Auth::guard('admin')->user()->id,
        'section_id'=>$categorydetails->section_id,
        'category_id'=>$request->category,
        'productname'=>$request->productname,
        'slug'=>Str::slug($request->productname),
        'brand_id'=>$request->brand,
        'productcode'=>$request->productcode,
        'productcolor'=>$request->productcolor,
        'groupcode'=>$request->groupcode,
        'productprice'=>$request->productprice,
        'productdiscount'=>$productdiscount,
        'productweight'=>$request->productweight,
        //'productimage'=>$productimage,
        'productdescription'=>$request->productdescription,
        'washcare'=>$request->washcare,
        'fabric'=>$request->fabric,
        'pattern'=>$request->pattern,
        'sleeve'=>$request->sleeve,
        'fit'=>$request->fit,
        'occassion'=>$request->occassion,
        'metattitle'=>$request->metattitle,
        'metadescription'=>$request->metadescription,
        'metakeyword'=>$request->metakeyword,
        'featured'=>$featured,
        'status'=>1,
    ]);
        return redirect()->route('admin.products')->withsuccess($request->productname.' product updated successfully');
    }
    public function deleteproductimage($id)
    {
        //dd($id);

        $productimage=Product::select('productimage')->where('id', $id)->first();
        $imagepathlarge='adminlte/adminimages/images/adminproducts/large/';
        $imagepathmedium='adminlte/adminimages/images/adminproducts/medium/';
        $imagepathsmall='adminlte/adminimages/images/adminproducts/small/';

        //delete category image from category image folder
        if (file_exists($imagepathlarge.$productimage->productimage)) {
            //dd($imagepath.$productimage->productimage);
            unlink($imagepathlarge.$productimage->productimage);
        }
        if (file_exists($imagepathmedium.$productimage->productimage)) {
            //dd($imagepath.$productimage->productimage);
            unlink($imagepathmedium.$productimage->productimage);
        }
        if (file_exists($imagepathsmall.$productimage->productimage)) {
            //dd($imagepath.$productimage->productimage);
            unlink($imagepathsmall.$productimage->productimage);
        }
        Product::where('id', $id)->update(
            [
            'productimage'=>'',
        ]
        );
        return back()->withdanger('product image deleted');
    }
    public function getaddattribute($id)
    {
        $productget=Product::select('id','productname','productcode','productcolor','productimage')->with('attributes')->find($id);
     //dd($productget);
        return view('admin.attribute.getaddattribute')->withproduct($productget);
    }
    public function postattribute(Request $request, $id)
    {
        // dd($request);
        $data=$request->all();
        foreach ($data['sku'] as $key=> $value) {
            if (!empty($value)) {
                $skucount=Productattribute::where(['sku'=>$value])->count();
                if($skucount>0){
                    return back()->withdanger('sku already exists');
                }
                $sizecount=Productattribute::where(['size'=>$data['size'],'product_id'=>$id])->count();
                if($sizecount>0){
                    return back()->withdanger('size is already taken choose another one');
                }
                $sizecount=Productattribute::where(['size'=>$data['size'],'product_id'=>$id])->count();
                if($sizecount>0){
                    return back()->withdanger('size is already taken choose another one');
                }
                $productattribute=new Productattribute();
                $productattribute->product_id=$id;
                $productattribute->sku=$value;
                $productattribute->size=$data['size'][$key];
                $productattribute->price=$data['price'][$key];
                $productattribute->stock=$data['stock'][$key];
                $productattribute->status=1;
                $productattribute->save();
            }
        }
        return back()->withsuccess('product attribute saved');

    }
    public function editproductattribute(Request $request,$id){
     //dd($id);
     //dd(json_decode(json_encode($request->all())));
     $data=$request->all();
     foreach($data['attrid'] as $key=>$attr){
         if(!empty($attr)){
             Productattribute::where(['id'=>$data['attrid'][$key]])->update([
                'price'=>$data['price'][$key],
                'stock'=>$data['stock'][$key],
             ]);
         }
     }
     return back()->withsuccess('product attribute updated');


    }
    public function deleteproductattribute($id){
      //  dd($id);
        Productattribute::where('id',$id)->delete();
        return back()->withsuccess('product  attribute trashed');

    }
    public function updateattributestatus(Request $request){
        if($request->ajax()){
            //  echo"<prev>";print_r($request->status);die;
              if($request->status=="Active"){
                  $status=0;
              }else{
                  $status=1;
              }
              Productattribute::where('id',$request->attribute_id)->update(['status'=>$status]);
              return response()->json(['status'=>$status,'attribute_id'=>$request['attribute_id']]);
          }

    }
    public function getaddmultipleimages($id){
        $productdata=Product::with('productimages')->select('id','productcode','productname','productcolor','productimage')->find($id);
        //dd(json_decode(json_encode($productdata)));

        return view('admin.product.getaddmultipleimages')->withproduct($productdata);
    }
    public function postmultipleimages(Request $request,$id){
       // dd($id);
      // dd($request->image);
     /*  $this->validate($request,[
           'image'=>'image|max:1999',
       ]);*/

            // dd($id);
            if ($request->hasFile('image')) {
                $image=$request->file('image');

                foreach($image as $key=>$imagee){
                     $productmultiple=new Productimage();
                     $img=Image::make($imagee);
                     //dd($img);
                     $filenamexactt=$imagee->getClientOriginalName();
                     $filename=pathinfo($filenamexactt, PATHINFO_FILENAME);
                       //  dd($filename);
                     $extension=$imagee->getClientOriginalExtension();
                     $imagename=$filename.rand(111,999999).time().".".$extension;
                     $large='adminlte/adminimages/images/adminproducts/large/'.$imagename;
                     $medium='adminlte/adminimages/images/adminproducts/medium/'.$imagename;
                     $small='adminlte/adminimages/images/adminproducts/small/'.$imagename;
                     Image::make($img)->resize(300, 450)->save($large);
                     Image::make($img)->resize(200, 300)->save($medium);
                     Image::make($img)->resize(100, 150)->save($small);
                     // $path=$request->file('image')->move('adminlte/adminimages/images/adminproducts',$filenametostore);
                     //dd($path);
                     $productmultiple->image=$imagename;
                     $productmultiple->product_id=$id;
                     $productmultiple->status=1;
                     $productmultiple->save();
                }
                return back()->withinfo('image saved');

            }
            return redirect()->back()->withsuccess('no file chosen');





    }
    public function deleteproductimagemultiple($id){
        Productimage::where('id',$id)->delete();
        return back()->withsuccess('product image   trashed');

    }
}
