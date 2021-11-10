<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'admin_id',
        'brand_id',
        'slug',
        'section_id',
        'category_id',
        'productname',
        'productcode',
        'productcolor',
        'productprice',
        'productdiscount',
        'productweight',
        'productimage',
        'groupcode',
        'productdescription',
        'washcare',
          'fabric',
          'pattern',
          'sleeve',
          'fit',
          'occassion',
          'metattitle',
          'metadescription',
          'metakeyword',
          'featured',
          'status',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function attributes(){
        return $this->hasMany(Productattribute::class);
    }
    public function productimages(){
        return $this->hasMany(Productimage::class)->select('id','product_id','image','status');
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public static function productFilters(){
        $productFilters=[
            [
                 'fabricArray'=>'cotton','polyster','wool','pure wool',
            ],
            [
                'sleeveArray'=>'full sleeve','half sleeve','short sleeve','sleeveless',
           ],
           [
            'patternArray'=>'checked','plain','printed','self','solid',
           ],
           [
            'fitArray'=>'regular','slim',
           ],
           [
            'occassionArray'=>'casual','formal',
           ],


        ];

        return $productFilters;

    }
    public static function getdiscountedprice($product_id){
        $prodductdetails=Product::select('id','category_id','productdiscount','productprice')->where('id',$product_id)->first()->toArray();
        $catdetails=Category::select('id','categorydiscount')->where('id',$prodductdetails['category_id'])->first()->toArray();
        if($prodductdetails['productdiscount']>0){
                 //sellingprice
            $discountedprice=$prodductdetails['productprice']-($prodductdetails['productprice']*$prodductdetails['productdiscount']/100);
       //  dd($discountedprice);
        }else if($catdetails['categorydiscount']>0){
            $discountedprice=$prodductdetails['productprice']-($prodductdetails['productprice']*$catdetails['categorydiscount']/100);

           }else{
               $discountedprice=0;
           }
           return $discountedprice;
        }
        public static function  getdiscountedattrprice($product_id,$size){
            $productattrprice=Productattribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
            $prodductdetails=Product::select('id','category_id','productdiscount')->where('id',$product_id)->first()->toArray();
            $catdetails=Category::select('id','categorydiscount')->where('id',$prodductdetails['category_id'])->first()->toArray();

            if($prodductdetails['productdiscount']>0){
                //sellingprice
           $discountedprice=$productattrprice['price']-($productattrprice['price']*$prodductdetails['productdiscount']/100);
               $discount=$productattrprice['price']-$discountedprice;
           //  dd($discountedprice);
       }else if($catdetails['categorydiscount']>0){
           $discountedprice=$productattrprice['price']-($productattrprice['price']*$catdetails['categorydiscount']/100);
           $discount=$productattrprice['price']-$discountedprice;

          }else{
              $discountedprice=$productattrprice['price'];
              $discount=0;
          }
          return array('discount'=>$discount,'productprice' =>$productattrprice['price'] ,'discounted_price'=> $discountedprice);
        }
        public static function orderproductimage($productid){
            $getproductimage=Product::select('productimage')->where('id',$productid)->first()->toArray();
           return $getproductimage['productimage'];
        }
        public static function getproductslug($productid){
            $getproductslug=Product::select('slug')->where('id',$productid)->first()->toArray();
           return $getproductslug['slug'];
        }

        public static function checkproductstatus($productid){
            $product=Product::select('status','productname')->where('id',$productid)->first()->toArray();
            return $product;
        }
        public static function deletecartitemifproductinactive($product_id){
            Cart::where('product_id',$product_id)->delete();
        }
        public static function checkifoutofstockbeforeplacingorder($productid,$productsize){
            $getproduct=Productattribute::select('product_id','stock','size','status')->where(['product_id'=>$productid,'size'=>$productsize])->first()->toArray();
            return $getproduct;
        }
       public static function getproductattributecount($productid,$productsize){
            $getattributecount=Productattribute::where(['product_id'=>$productid,'size'=>$productsize,'status'=>1])->count();
             return $getattributecount;
        }
        public static function getcategorystatus($categoryid){
            $categorystatus=Category::select('status')->where('id',$categoryid)->first()->toArray();
            return $categorystatus;
        }
}