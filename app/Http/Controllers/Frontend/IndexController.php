<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
     // dd("jh");
     // dd(json_decode(json_encode("Thanks to God.A new Countdown starts"),true));
        $page="index";
        $banners=Banner::where('status',1)->get()->toArray();
        //dd($banners);
        $getsections=Section::with('categories')->where('status',1)->get();
      // dd($getsections);
        $featuredproducts=Product::Where('featured',1)->where('status',1)->count();
       // dd($featuredproducts);
       $featuredproductss=Product::where('featured',1)->where('status',1)->get()->toArray();
          $featuredproductsschunk=array_chunk($featuredproductss,4);
        // dd($featuredproductsschunk);
      $latestproducts=Product::orderBy('created_at','DESC')->where('status',1)->limit(20)->get()->toArray();
        return view('Frontend.front.index')
        ->withbanners($banners)
        ->withfeaturedproducts($featuredproducts)
        ->withlatestproducts($latestproducts)
        ->withfeaturedproductsschunk($featuredproductsschunk)
        ->withsections($getsections)->withpage($page);
    }
}