<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Section;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $page="index";
        $banners=Banner::where('status',1)->get()->toArray();
        $getsections=Section::with('categories')->where('status',1)->get();
        $featuredproducts=Product::Where('featured',1)->where('status',1)->count();
       // dd($featuredproducts);
       $featuredproductss=Product::where('featured',1)->where('status',1)->get()->toArray();
          $featuredproductsschunk=array_chunk($featuredproductss,4);
      //    dd($featuredproductsschunk);
      $latestproducts=Product::orderBy('created_at','DESC')->where('status',1)->limit(10)->get()->toArray();
        return view('Frontend.front.index')
        ->withbanners($banners)
        ->withfeaturedproducts($featuredproducts)
        ->withlatestproducts($latestproducts)
        ->withfeaturedproductsschunk($featuredproductsschunk)
        ->withsections($getsections)->withpage($page);
    }
}
