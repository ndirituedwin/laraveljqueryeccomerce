<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Productattribute;

class ProductController extends Controller
{
    public function listing(Request $request,$slug){
      if($request->ajax()){
        $data=$request->all();
      // echo"<pre>";print_r($data);die;   

        //dd($categorydetails);
        $categorycount=Category::where(['slug'=>$slug,'status'=>1])->count();
        if($categorycount>0){
          $categorydetails=Category::catdetails($data['slug']);
          $getsections=Section::with('categories')->where('status',1)->get();
          $categoryproducts=Product::with('brand')->whereIn('category_id',$categorydetails['catIds'])->where('status',1);
  
          if(isset($data['fabric']) && !empty($data['fabric'])){
            $categoryproducts->whereIn('products.fabric',$data['fabric']);
          }
          if(isset($data['sleeve']) && !empty($data['sleeve'])){
            $categoryproducts->whereIn('products.sleeve',$data['sleeve']);
          }

          if(isset($data['pattern']) && !empty($data['pattern'])){
            $categoryproducts->whereIn('products.pattern',$data['pattern']);
          }
          if(isset($data['fit']) && !empty($data['fit'])){
            $categoryproducts->whereIn('products.fit',$data['fit']);
          }
          if(isset($data['occassion']) && !empty($data['occassion'])){
            $categoryproducts->whereIn('products.occassion',$data['occassion']);
          }

       if(isset($data['sort']) && !empty($data['sort'])){
        if($data['sort']=="latestproducts"){
          //dd("v");
          $categoryproducts->orderBy('created_at','DESC');
        }
        if($data['sort']=="atoz"){
          //dd("v");
          $categoryproducts->orderBy('productname','ASC');
        }
        if($data['sort']=="ztoa"){
          //dd("v");
          $categoryproducts->orderBy('productname','DESC');
        }
       
        if($data['sort']=="lowestpice"){
          //dd("v");
          $categoryproducts->orderBy('productprice','ASC');
        }
        if($data['sort']=="highestprice"){
          //dd("v");
          $categoryproducts->orderBy('productprice','DESC');
        }
      }else{
        $categoryproducts=$categoryproducts->orderBy('created_at','DESC');
      }
      $categoryproducts=$categoryproducts->paginate(10);
        return view('Frontend.listings.ajaxproductlisting')
        ->withslug($slug)
        ->withcategorydetails($categorydetails)
        ->withsections($getsections)
        ->withproducts($categoryproducts);

        }
        return back();
            //  dd($categoryproducts);
     
       }

               $categorycount=Category::where(['slug'=>$slug,'status'=>1])->count();
           $getsections=Section::with('categories')->where('status',1)->get();
           if($categorycount>0){
            $categorydetails=Category::catdetails($slug);
            //dd($categorydetails);
            $categoryproducts=Product::with('brand')->whereIn('category_id',$categorydetails['catIds'])->where('status',1);
          //  dd($categoryproducts);
          $categoryproducts=$categoryproducts->paginate(10);
          $productFilters=Product::productFilters();
          $fabric=$productFilters['0'];
          $pattern=$productFilters['2'];
          $sleeve=$productFilters['1'];
          $fit=$productFilters['3'];
          $occassion=$productFilters['4'];
       //   echo"<pre>";print_r($productFilters);
            $page="listing";
            return view('Frontend.listings.listing')
            ->withlisting($page)
            ->withfabrics($fabric)
            ->withpatterns($pattern)
            ->withsleeves($sleeve)
            ->withfits($fit)
            ->withoccassions($occassion)
            ->withslug($slug)
            ->withcategorydetails($categorydetails)
            ->withsections($getsections)
            ->withproducts($categoryproducts);
           }
           return back();
    }
    public function singleproductpage($slug){
   // dd($slug);
    $product=Product::with(['category','brand','attributes'=>function($query){
      $query->where('status',1);
    },'productimages'])->where('slug',$slug)->first()->toArray();
    //dd($product); 
    $p=$product['id'];
     $ptoductid=Productattribute::where('product_id',$p)->sum('stock');
     $relatedproducts=Product::where('category_id',$product['category']['id'])->where('id','!=',$p)->inRandomOrder()->get()->toArray();
    $getsections=Section::with('categories')->where('status',1)->get();
      return view('Frontend.front.singleproduct')
      ->withsumofstock($ptoductid)
      ->withsections($getsections)
      ->withrelatedproducts($relatedproducts)
      ->withproduct($product);
    }
    public function getproductprice(Request $request){
      
      if($request->ajax()){
        $data=$request->all();
     //        echo"<pre>";print_r($data);die;
     //   $productprice=Productattribute::Where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first();
         $discounted_price=Product::getdiscountedattrprice($data['product_id'],$data['size']);
        //  echo"<pre>";print_r($productprice->price);die;
        return $discounted_price;
      //  return $productprice->price;

      }
    }
}
