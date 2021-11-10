<?php

use App\Models\Coupon;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Admin\brandcontroller;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\Checkoutcontroller;
use App\Http\Controllers\Frontend\Payments\LipanampesaController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\SocialAuthcontroller;
use App\Http\Controllers\Admin\UsersController as UserCon;
use App\Http\Controllers\Admin\CmspagesController;
use App\Models\Cmspage;
use FontLib\Table\Type\name;
use App\Http\Controllers\Frontend\CmspageController;
use App\Http\Controllers\Admin\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/',[WelcomeController::class,'welcome'])->name('welcome');
Route::group(['middleware'=>'guest'],function(){
    Route::get('/signup',[AuthController::class,'getsignup'])->name('auth.getsignup');
    Route::post('/signup',[AuthController::class,'postsignup']);
    Route::get('/signin',[AuthController::class,'getsignin'])->name('auth.getsignin');
    Route::post('/signin',[AuthController::class,'postsignin']);
   Route::get('login/google',[AuthController::class,'redirecttogoogle'])->name('google.redirect');
   Route::get('login/google/callback',[AuthController::class,'handlegooglecallback']);

//    Route::get('login/google',[SocialAuthcontroller::class,'googleredirect'])->name("google.redirect");
//    Route::get('login/google/callback',[SocialAuthcontroller::class,'googlecallback']);


});
Route::post('/signout',[AuthController::class,'signout'])->name('auth.signout');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/updateprofile',[ProfileController::class,'geteditprofile'])->name('profile.edit');
    Route::post('/updateprofile',[ProfileController::class,'posteditprofile']);
    Route::get('/home',[HomeController::class,'home'])->name('home');
});
//adminsection
Route::prefix('admin')->namespace('Admin')->group(function(){
   Route::get('/adminlogin',[Admincontroller::class,'getadminlogin'])->name('admin.login');
   Route::post('/adminlogin',[Admincontroller::class,'postadminlogin']);
   Route::group(['middleware'=>['admin']],function(){
    Route::get('/view-orderinvoice/{orderid}',[AdminOrdersController::class,'vieworderinvoice'])->name('vieworder.invoice');
    Route::get('/printorder-pdf/{orderid}',[AdminOrdersController::class,'printorderinvoice'])->name('printorder.pdf');
    Route::get('/dashboard',[Admincontroller::class,'dashboard'])->name('dashboard');
  Route::post('/adminlogout',[Admincontroller::class,'adminlogout'])->name('admin.logout');
  Route::get('/settings',[Admincontroller::class,'getadminsettings'])->name('admin.settings');
  Route::post('/settings',[Admincontroller::class,'postadminsettings']);
  Route::post('checkcurrentpassword',[Admincontroller::class,'checkcurrentpassword']);
  Route::post('confirmationofpasswords',[Admincontroller::class,'checkconfirmpasswords']);
  Route::get('/updateadmindetails',[Admincontroller::class,'getupdateadmindetails'])->name('update.admindetails');
  Route::post('/updateadmindetails',[Admincontroller::class,'updateadmindetails']);
  Route::get('/updatesectionstatu',[SectionController::class,'getsections'])->name('admin.getsections');
  Route::post('/updatesectionstat',[SectionController::class,'updatesectionstatus']);
  Route::get('/categoriessection',[CategoryController::class,'getcategories'])->name('admin.categories');
  Route::get('/categories',[CategoryController::class,'getaddcategory'])->name('category.modify');
  Route::get('/getcategories/{id}',[CategoryController::class,'geteditcategory'])->name('category.getedit');
  Route::post('/getcategories/{id}',[CategoryController::class,'posteditcategory']);
  Route::get('/delete-image/{id}',[CategoryController::class,'deletecategoryimage'])->name('delete.categoryimage');
  Route::get('/delete-category/{id}',[CategoryController::class,'deletecategory'])->name('category.delete');
  Route::get('/delete-product/{id}',[ProductController::class,'deleteproduct'])->name('product.delete');
  Route::get('/delete-productimage/{id}',[ProductController::class,'deleteproductimage']);
  Route::get('/delete-attribute/{id}',[ProductController::class,'deleteproductattribute']);
  Route::post('/updateproductattributestatus',[ProductController::class,'updateattributestatus']);
  Route::post('/updateimagestatus',[ProductController::class,'updateimagestatus']);
  Route::post('/categories',[CategoryController::class,'addcategory']);
  Route::post('/updatecategorystatu',[CategoryController::class,'categoriesstatus']);
  Route::post('updateadmincategories',[CategoryController::class,'updateadmincategories']);
  Route::post('updateproductstatus',[ProductController::class,'productstatusupdate']);
  Route::get('/getproducts',[ProductController::class,'getallproducts'])->name('admin.products');
  Route::get('/addproducts',[ProductController::class,'getaddproducts'])->name('admin.getproducts');
  Route::get('/products/{id}',[ProductController::class,'editproducts'])->name('admin.modifyproduct');
  Route::post('/products/{id}',[ProductController::class,'posteditproduct']);
  Route::post('/products/post/products',[ProductController::class,'addproducts'])->name('product.post');
  Route::get('/products/attribute/{id}',[ProductController::class,'getaddattribute'])->name('admin.attribute');
  Route::post('/products/attribute/{id}',[ProductController::class,'postattribute']);
  Route::post('/products/attribute/update/{id}',[ProductController::class,'editproductattribute'])->name('edit.productattribute');
  Route::get('/products/images/{id}',[ProductController::class,'getaddmultipleimages'])->name('admin.addmultipleimages');
  Route::post('/products/images/{id}',[ProductController::class,'postmultipleimages']);
  Route::get('/delete-imageproduct/{id}',[ProductController::class,'deleteproductimagemultiple']);
//brands
Route::get('/brands',[brandcontroller::class,'getallbrands'])->name('admin.brands');
Route::get('/brandsmodify',[brandcontroller::class,'getaddbrand'])->name('admin.modifybrand');
Route::post('/brandsmodify',[brandcontroller::class,'postbrand']);
Route::get('/brandedit/{id}',[brandcontroller::class,'geteditbrand'])->name('brand.edit');
Route::post('/brandedit/{id}',[brandcontroller::class,'posteditbrand']);
Route::get('/delete-brand/{id}',[brandcontroller::class,'deletebrand']);
Route::post('updatebrandstatus',[brandcontroller::class,'updatebrandstatus']);
//banners
Route::get('/banners',[BannersController::class,'getbanners'])->name('admin.banners');
Route::get('/delete-banner/{id}',[BannersController::class,'deletebanner']);
Route::post('/updatebannerstatus',[BannersController::class,'updatebannerstatus']);
Route::get('/getadddbanner',[BannersController::class,'getaddbanner'])->name('banner.getadd');
Route::post('/getadddbanner',[BannersController::class,'postbanner']);
Route::get('/geteditbannner/{id}',[BannersController::class,'editbanner'])->name('banner.edit');
Route::post('/geteditbannner/{id}',[BannersController::class,'posteditbanner']);
Route::get('/delete-banner/{id}',[BannersController::class,'deletebanner']);
Route::get('/delete-bannerimage/{id}',[BannersController::class,'deletebannerimage']);
//coupons
Route::get('/coupons',[CouponController::class,'getcoupons'])->name('admin.coupons');
Route::get('/coupon',[CouponController::class,'getaddcoupon'])->name('coupon.getadd');
Route::post('/coupon',[CouponController::class,'postaddcoupon']);

Route::get('/editcoupon/{id}',[CouponController::class,'editcoupon'])->name('coupon.edit');
Route::post('/editcoupon/{id}',[CouponController::class,'posteditcoupon']);
Route::post('/updatecouponstatus',[CouponController::class,'updatecoupontatus']);
Route::get('/delete-coupon/{id}',[CouponController::class,'deletecoupon']);
//orders
Route::get('/getorders',[AdminOrdersController::class,'getorders'])->name('admin.orders');
Route::get('/singleorder/{Order}',[AdminOrdersController::class,'getsingleorder'])->name('orders.getsingle');
Route::post('/updateorderstuses',[AdminOrdersController::class,'updateorderstatus'])->name('update.orderstatus');

//shipping
Route::get('/getshippingcharges',[ShippingController::class,'shippingcharges'])->name('admin.shipping');
Route::get('/editshippingcharge/{shippingid}',[ShippingController::class,'shippingchargesedit'])->name('admin.editshippingcharge');
Route::post('/addshippingcharges/{shipping}',[ShippingController::class,'addshippingcharges'])->name('shippingcharge.edit');
Route::post('updateshippingstatus',[ShippingController::class,'updateshippingstatus']);
//users
Route::get('/get/users',[UserCon::class,'users'])->name('admin.getusers');
Route::post('updateuserstatus',[UserCon::class,'updateuserstatus']);
//cmspages
Route::get('/get/cms-pages',[CmspagesController::class,'cmspages'])->name('admin.cmspages');
Route::get('/get/cms-pages/{cmspge}',[CmspagesController::class,'cmspagesedit'])->name('cmspage.edit');
Route::post('updatecmspagestatus',[CmspagesController::class,'updatecmspagestatus']);
Route::match(['get', 'post'], '/cms-add-edit/{id?}', [CmspagesController::class,'updatecmspage'])->name('cmspage.modify');
Route::get('/delete-cmspage/{id}',[CmspagesController::class,'cmspagedelete']);

//roles(admins subadmins)
Route::get('/get-admins',[RolesController::class,'getadmins'])->name('roles.render');
Route::post('updateadminstatus',[RolesController::class,'updateadminstatus']);
Route::get('/delete-admin/{id}',[RolesController::class,'deleteadmin']);
Route::match(['get', 'post'], '/add-edit/subadmin/{id?}', [RolesController::class,'addeditsubadmin'])->name('admin.addedit');
Route::get('/edit-admin/{id}',[RolesController::class,'editadmin'])->name('admin.edit');
Route::match(['get','post'],'/update-adminroles/{id?}',[RolesController::class,'updateadminroles'])->name('admin.updateroles');

});


});
Route::namespace('Frontend')->group(function(){
Route::get('/',[IndexController::class,'index'])->name('frontend.index');
//cmspageurls
$cmspagesurl=Cmspage::select('slug')->where('status',1)->get()->pluck('slug')->toArray();
foreach ($cmspagesurl as $url) {
    Route::get('/'.$url,[CmspageController::class,'cmspage'])->name('cms.pagesss');
    // Route::get('/',[CmspageController::class,'cmspage'])->name('cms.pagesss');

}
//contact-us page
Route::match(['get', 'post'],'/contact',[CmspageController::class,'contactus'])->name('contact.us');
Route::get('/search-products',[FrontendProductController::class,'listing'])->name('search.products');

Route::get('/categoryproducts/{Category:slug}',[FrontendProductController::class,'listing'])->name('category.products');
Route::post('/checkifpincodeexists',[FrontendProductController::class,'checkifpincodeexists']);
Route::get('/singleproduct/{product:slug}',[FrontendProductController::class,'singleproductpage'])->name('singlepro.getdetails');
Route::post('/get-product-size',[FrontendProductController::class,'getproductprice'])->name('product.getprice');
Route::post('/addproducttocart',[CartController::class,'addproducttocart'])->name('addproduct.tocart');
Route::get('/getcart',[CartController::class,'cart'])->name('cart.show');
Route::post('/updatecartquantitywithajax',[CartController::class,'updatecartquantity']);
Route::post('/deletecartitemwithajax/easily',[CartController::class,'deletecartitemwithajax']);
Route::get('/frontend/delete-cartitem/{id}',[CartController::class,'deletecartitemwithajax']);
//login register route
//paypalcontroller
Route::get('/paypal/getpaypal',[PaypalController::class,'paypal'])->name('paypal.show');
Route::get('/paypal/success',[PaypalController::class,'paypalsuccess'])->name('paypal.success');
Route::get('/paypal/failure',[PaypalController::class,'paypalfailure'])->name('paypal.failed');
Route::any('/paypal/ipn',[PaypalController::class,'paypalipnurl'])->name('paypal.ipnurl');
Route::group(['middleware'=>'guest'],function(){
    Route::get('/registeruser',[UsersController::class,'getregisteruser'])->name('auth.registeruser');
    Route::post('/registeruser',[UsersController::class,'postregisteruser']);
    Route::get('/loginuser',[UsersController::class,'getloginuser'])->name('client.getlogin');
    Route::post('/loginuser',[UsersController::class,'postloginuser']);
    Route::post('/frontend/checkcurrentpassword',[UsersController::class,'checkcurrentpassword']);
    Route::post('/frontend/confirmationofpasswords',[UsersController::class,'checkconfirmpasswords']);
    Route::post('/frontend/checkemail',[UsersController::class,'checkemail']);
    Route::post('/frontend/checkphonenumber',[UsersController::class,'checkphonenumber']);
    Route::post('/frontend/checkemailclient',[UsersController::class,'checkemailclient']);
    Route::get('/acountactivation/{code}',[UsersController::class,'activateaccount'])->name('acount.activation');
    //Route::post('/acountactivation/{code}',[UsersController::class,'postactivateaccount']);
  });
  Route::get('/forgotpassword',[UsersController::class,'forgotpassword'])->name('password.forgot');

Route::group(['middleware'=>'auth'],function(){
    //Route::get('/forgotpassword',[UsersController::class,'forgotpassword'])->name('password.forgot');

    Route::get('/useraccount',[UsersController::class,'useraccount'])->name('user.account');
    Route::post('/useraccount',[UsersController::class,'postuseraccount']);
    Route::get('/ordersuser',[OrdersController::class,'getuserorders'])->name('user.orders');
    Route::get('/userorder/viewdetails/{id}',[OrdersController::class,'viewuserorderdetails'])->name('order.viewitdetails');
Route::post('/client/updatepasssword',[UsersController::class,'updatepasswordclient'])->name('user.updatepassword');
    Route::post('/front/currentpass',[UsersController::class,'check']);
    Route::post('/front/confirmpassword',[UsersController::class,'checkcofirmpasswords']);
//apply coupon
Route::post('/cart/couponcodeapply',[CartController::class,'applycoupon']);
Route::get('/user/checkout',[Checkoutcontroller::class,'checkout'])->name('checkout.page');
Route::post('/user/checkout',[Checkoutcontroller::class,'checkoutpost']);
Route::get('/user/deliveryaddress',[Checkoutcontroller::class,'deliveryaddress'])->name('delivery.add');
Route::post('/user/deliveryaddress',[Checkoutcontroller::class,'deliveryaddressadd']);
Route::get('/deliveryaddress/edit/{id}',[Checkoutcontroller::class,'deliveryaddressedit'])->name('delivery.edit');
Route::post('/deliveryaddress/edit/{id}',[Checkoutcontroller::class,'deliveryaddresspostedit']);
Route::get('/deliveryaddress/delete/{id}',[Checkoutcontroller::class,'deliveryaddressdelete'])->name('delivery.deleteaddess');
Route::get('/thankscod/page',[Checkoutcontroller::class,'thankspage'])->name('CODthanks.page');
Route::get('/lipa/nampesa',[LipanampesaController::class,'lipanampesa'])->name('lipa.nampesa');
//Route::post('/get-token',[LipanampesaController::class,'getaccesstoken']);


});
Route::post('/forgotpassword',[UsersController::class,'forgotpasswordpost']);
Route::post('/logoutclient',[UsersController::class,'clientlogout'])->name('auth.clientlogout');
});
Route::post('/getaccesstoken',[LipanampesaController::class,'getmpesaaccesstoken']);