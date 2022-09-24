<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\CouponController;

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


Auth::routes();

//  user route

Route::get('/home', 'UserController@index')->name('home');

Route::get('/', 'UserController@index');
// Route::get('/getProductByCategory/{Category}', 'UserController@getProductByCategory');
Route::get('/getProductByCategory', 'UserController@getProductByCategory');

Route::get('/categoryPage/{id}', 'UserController@categoryPage');
Route::get('/SubCategoryPage/{id}', 'UserController@SubCategoryPage');
Route::get('/shop', 'UserController@ShopPage')->name('shop');
Route::post('/filterdata', 'FilterController@filterPage')->name('filter');
Route::post('/filterPriceData', 'FilterController@filterPriceData')->name('filterPriceData');
Route::post('/colorFilter', 'FilterController@colorFilter')->name('colorFilter');
Route::post('/sizeFilter', 'FilterController@sizeFilter')->name('sizeFilter');
Route::get('/shop-search', 'UserController@search');
Route::get('/filter', 'UserController@FilterProduct');
Route::get('/sizecolor/{id}/{pid}', 'UserController@SizeByColor');
Route::post('/sizecolorprice', 'UserController@SizeColorByPrice');
Route::get('/sizecolor', 'UserController@SizeByColors');
// customer details product
Route::get('/detailsProduct/{id}', 'UserController@detailsProduct')->middleware('auth');
Route::get('/contact-us', 'ContactController@getContactPage');
// Route::post('/contact-us', 'ContactController@storeContact');
Route::post('/contact-us', 'ContactController@storeContact')->name('contactPost');
Route::post('/subscribe', 'ContactController@SubscribeStore')->name('subscribe');
// shipping page
// Route::get('/shipping/{id}', 'UserController@shippingPage');

Route::get('/userdashboard', 'UserController@userdashboard')->middleware('auth');
Route::get('/userdashboard/order', 'UserController@userOrder')->middleware('auth');
Route::get('/userdashboard/orderDetails/{id}', 'UserController@userOrderDetails')->name('userOrderDetails')->middleware('auth');
Route::get('searchproduct', 'UserController@searchproduct')->name('searchproduct');

// pdf 
Route::get('/generate-pdf/{id}', 'UserController@generatePDF')->middleware('auth');
Route::get('/view-pdf/{id}', 'UserController@viewPDF')->middleware('auth');
Route::get('/updateusershippingarea', 'UserController@updateusershippingareapage')->middleware('auth');
Route::post('/updateshippingAddress', 'UserController@updateshippingAddress')->middleware('auth');
Route::get('/getpassword', 'UserController@getpassword')->middleware('auth');
Route::post('/changepassword', 'UserController@changepassword')->middleware('auth');
Route::post('/updateuserinfo', 'UserController@updateuserinfo')->middleware('auth');

// add to cart
Route::post('/addToCart','CartController@addToCartProduct')->middleware('auth');

// cart page route
Route::get('/shipping-details','UserController@ShippingCartDetailsPage')->middleware('auth');
Route::get('/cartItems','CartController@ShippingCartDetails')->middleware('auth');
Route::post('/cartIncrement','CartController@cartIncrement')->middleware('auth');
Route::post('/cartDecrement','CartController@cartDecrement')->middleware('auth');
Route::post('/cartDelete','CartController@cartDelete')->middleware('auth');
Route::get('/allCartItem','CartController@allCartItem');
Route::get('/subtotal','CartController@subtotal')->middleware('auth');
Route::post('/shippingAddress','CartController@shippingAddress')->middleware('auth');

 // User Notification
 Route::get('/usernotification/{id}','NotificationController@usershow')->name('user.notification')->middleware('auth');
 Route::get('/usernotifications','NotificationController@userindex')->name('userall.notification')->middleware('auth');
 Route::delete('/usernotification/{id}','NotificationController@userdelete')->name('usernotification.delete')->middleware('auth');

 // frontend apply coupon

Route::post('/apply-coupon','CouponController@applyCoupon')->middleware('auth');

// review route

// Route::post('/review-store',[UserController::class, 'reviewstore'])->name('review.store');
Route::post('/review-store','UserController@reviewstore')->middleware('auth');


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/checkout', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->middleware('auth');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->middleware('auth');

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->middleware('auth');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->middleware('auth');

Route::post('/success', [SslCommerzPaymentController::class, 'success'])->middleware('auth');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->middleware('auth');
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->middleware('auth');

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->middleware('auth');
//SSLCOMMERZ END


// Cash on Delivery
Route::post('/cashondelivery', [SslCommerzPaymentController::class, 'cashondelivery'])->middleware('auth');

   // admin route


   Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');
  
   // category Controller

   Route::get('/category', 'CategoryController@index')->middleware('admin');
   Route::post('/category', 'CategoryController@store')->middleware('admin');
   Route::get('/allcategory', 'CategoryController@allcategory')->middleware('admin');
   Route::post('/categoryDelete', 'CategoryController@categoryDelete')->middleware('admin');
   
   Route::get('/catbyproduct', 'CategoryController@catbyproduct')->middleware('admin');
   Route::post('/categoryDetails','CategoryController@categoryDetails')->middleware('admin');
   Route::post('/updateCategory','CategoryController@updateCategory')->middleware('admin');


// change status
Route::post('/categoryStatus','StatusController@categoryStatus');

// subcategory subcategory
Route::get('/subcategory', 'SubCategoryController@index')->middleware('admin');
Route::post('/subcategory', 'SubCategoryController@store')->middleware('admin');
Route::get('/allsubcategory', 'SubCategoryController@allsubcategory')->middleware('admin');
Route::post('/subcategoryDelete', 'SubCategoryController@subcategoryDelete')->middleware('admin');
Route::post('/subcategoryStatus','SubCategoryController@subcategoryStatus')->middleware('admin');
Route::post('/subCatDetails','SubCategoryController@subCatDetails')->middleware('admin');
Route::post('/updateSubCat','SubCategoryController@updateSubCat')->middleware('admin');


// Brand 
Route::get('/brands', 'BrandController@index')->middleware('admin');
Route::post('/brands', 'BrandController@store')->middleware('admin');
Route::get('/allbrands', 'BrandController@allbrands')->middleware('admin');
Route::post('/brandsDelete', 'BrandController@brandsDelete')->middleware('admin');
Route::post('/brandsStatus','BrandController@brandsStatus')->middleware('admin');
Route::post('/brandsDetails','BrandController@brandsDetails')->middleware('admin');
Route::post('/updateBrand','BrandController@updateBrand')->middleware('admin');


// color
Route::get('/colors', 'ColorController@index')->middleware('admin');
Route::post('/colors', 'ColorController@store')->middleware('admin');
Route::get('/allcolors', 'ColorController@allcolors')->middleware('admin');
Route::post('/colorsDelete', 'ColorController@colorsDelete')->middleware('admin');
Route::post('/colorsStatus','ColorController@colorsStatus')->middleware('admin');
Route::post('/colorsDetails','ColorController@colorsDetails')->middleware('admin');
Route::post('/updateColor','ColorController@updateColor')->middleware('admin');


// size
Route::get('/size', 'SizeController@index')->middleware('admin');
Route::post('/size', 'SizeController@store')->middleware('admin');
Route::get('/allsize', 'SizeController@allsize')->middleware('admin');
Route::post('/sizeDelete', 'SizeController@sizeDelete')->middleware('admin');
Route::post('/sizeStatus','SizeController@sizeStatus')->middleware('admin');
Route::post('/sizeDetails','SizeController@sizeDetails')->middleware('admin');
Route::post('/updateSize','SizeController@updateSize')->middleware('admin');

Route::get("addmore","SizeController@addMore")->middleware('admin');
Route::post("addmore","SizeController@addMorePost")->middleware('admin');

// units
Route::get('/units', 'UnitController@index')->middleware('admin');
Route::post('/units', 'UnitController@store')->middleware('admin');
Route::get('/allunits', 'UnitController@allunits')->middleware('admin');
Route::post('/unitsDelete', 'UnitController@unitsDelete')->middleware('admin');
Route::post('/unitsStatus','UnitController@unitsStatus')->middleware('admin');
Route::post('/unitsDetails','UnitController@unitsDetails')->middleware('admin');
Route::post('/updateUnit','UnitController@updateUnit')->middleware('admin');

// Banners
Route::get('/banners', 'BannerController@index')->middleware('admin');
Route::post('/banners', 'BannerController@store')->middleware('admin');
Route::get('/allbanners', 'BannerController@allbanners')->middleware('admin');
Route::post('/bannersDelete', 'BannerController@bannersDelete')->middleware('admin');
Route::post('/bannersStatus','BannerController@bannersStatus')->middleware('admin');
Route::post('/bannersDetails','BannerController@bannersDetails')->middleware('admin');
Route::post('/updateBanner','BannerController@updateBanner')->middleware('admin');

// settings route updateOrderStatus
 // Settings
 Route::get('settings','AdminController@settings')->name('settings')->middleware('admin');
 Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update')->middleware('admin');


// Product Controller productDelete

Route::get('/products', 'ProductController@index')->middleware('admin');
Route::post('/products', 'ProductController@store')->middleware('admin');
Route::get('/allproducts', 'ProductController@allproducts')->middleware('admin');
Route::post('/productDelete', 'ProductController@productDelete')->middleware('admin');
Route::post('/productDetails', 'ProductController@productDetails')->middleware('admin');
Route::post('/updateProduct', 'ProductController@updateProduct')->middleware('admin');
Route::post('/productsStatus', 'StatusController@productsStatus')->middleware('admin');


// Admin Image Gallery
Route::get('upload-images', 'PhotoController@index')->middleware('admin');
Route::post('upload-images-ajax', 'PhotoController@store')->middleware('admin');
Route::post('/uploadGaleryImage', 'PhotoController@uploadGaleryImage')->middleware('admin');
Route::get('/getImages', 'PhotoController@getImages')->middleware('admin');
Route::get('/getImages/{id}', 'PhotoController@getImageById')->middleware('admin');
Route::post('/image-delete', 'PhotoController@deleteImage')->middleware('admin');
Route::post('/downloadImg', 'PhotoController@downloadImg')->middleware('admin');
Route::get('/downloadImg/{id}', 'PhotoController@downloadImgbyid')->middleware('admin');

// Admin Photo Gallery
Route::get('/photos', 'PhotoController@PhotoIndex')->middleware('admin');
Route::post('/PhotoUpload', 'PhotoController@PhotoUpload')->middleware('admin');
Route::get('/PhotoJSON', 'PhotoController@PhotoJSON')->middleware('admin');
Route::get('/PhotoJSONByID/{id}', 'PhotoController@PhotoJSONByID')->middleware('admin');
Route::post('/PhotoDelete', 'PhotoController@PhotoDelete')->middleware('admin');


// admin coupon manage
Route::get('/coupon','CouponController@index')->middleware('admin');
Route::get('/coupon/manage_coupon',[CouponController::class,'manage_coupon'])->middleware('admin');
Route::get('/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon'])->middleware('admin');
Route::post('/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process')->middleware('admin');
Route::get('/coupon/delete/{id}',[CouponController::class,'delete'])->middleware('admin');
Route::get('/coupon/status/{status}/{id}',[CouponController::class,'status'])->middleware('admin');

// admin order management

Route::get('/allOrders', 'AdminController@allOrdersPage')->middleware('admin');
Route::get('/allOrdersData', 'AdminController@allOrders')->middleware('admin');
Route::post('/OrdersDetails', 'AdminController@OrdersDetails')->middleware('admin');
Route::post('/updateOrderStatus', 'AdminController@updateOrderStatus')->middleware('admin');
Route::get('/adminOrderDetails/{id}', 'AdminController@AdminOrderDetails')->name('userOrderById')->middleware('admin');
Route::post('/OrdersDelete', 'AdminController@AdminOrdersDelete')->middleware('admin');

 // Admin Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification')->middleware('admin');
    Route::get('/notifications','NotificationController@index')->name('all.notification')->middleware('admin');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete')->middleware('admin');


// admin order pdf invoice 
Route::get('/AdminPdfInvoice/{id}', 'AdminController@AdminPdfInvoiceGenarate')->middleware('admin');
Route::get('/AdminPdfInvoiceView/{id}', 'AdminController@AdminPdfInvoiceViewGenarate')->middleware('admin');



// admin product attribute management
Route::post('/productattr','ProductController@AddProductAttr')->middleware('admin');


// cart page route

// Route::get('/checkout','UserController@checkoutPage')->middleware('auth');

// Shipping
Route::resource('/shipping','ShippingController')->middleware('admin');


// visitor route
Route::get('/visitor', 'VisitorController@VisitorIndex')->middleware('admin');
Route::get('/getVisitor', 'VisitorController@getVisitor')->middleware('admin');
Route::post('/DeleteVisitor', 'VisitorController@DeleteVisitor')->middleware('admin');
Route::get('/singleVisitorPage/{id}', 'VisitorController@singleVisitorPage')->middleware('admin');

// user route
Route::get('/admin/users', 'VisitorController@UserIndex')->middleware('admin');
Route::get('/admin/getUser', 'VisitorController@getUser')->middleware('admin');
Route::post('/admin/DeleteUser', 'VisitorController@DeleteUser')->middleware('admin');
Route::get('/admin/singleUserPage/{id}', 'VisitorController@singleUserPage')->middleware('admin');
Route::get('/admin/active_user', 'VisitorController@active_user')->middleware('admin');

Route::post('/send-sms', 'VisitorController@sendSms')->middleware('admin');
Route::get('sendSms', 'VisitorController@sendSms2')->middleware('admin');

