<?php

use App\Http\Middleware\FrontAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('front/login','front\FrontAuth@login')->name('front.login');

Route::post('front/login','front\FrontAuth@dologin')->name('front.dologin');

Route::get('forget-password','front\FrontAuth@forgot_password');
Route::post('forget-password','front\FrontAuth@forgot_password_post')->name('forgetPassword');

Route::post('front/register','front\FrontAuth@register')->name('front.register');
Route::get('/confirm/{code}','front\FrontAuth@confirmAccount')->name('confirmAccount');

Route::post('/check-email','front\FrontAuth@checkEmail');
Route::match(['get', 'post'],'/check-email','front\FrontAuth@checkEmail');



Route::get('/','front\FrontController@index')->name('welcome');


//category / listing page
Route::get('products/{url}','Dashboard\ProductController@products');

// product details page
Route::get('product/{id}','Dashboard\ProductController@product');

Route::get('products_details/change-price','front\FrontController@change_price');

Route::group(['middleware' => 'front'],function(){

        //logout route
        Route::any('front/logout','front\FrontAuth@logout')->name('front.logout');

        //user account
        Route::match(['get','post'],'account','front\FrontAuth@account');

        // Check User Current Password
        Route::post('/check-user-pwd','front\FrontAuth@chkUserPassword');
        // Update User Password
        Route::post('/update-user-pwd','front\FrontAuth@updatePassword');

        // Cart Page
        Route::match(['get', 'post'],'/cart','Dashboard\ProductController@cart');

        // Add to Cart Route
        Route::match(['get', 'post'], '/add-cart', 'Dashboard\ProductController@addtocart')->name('product.add-cart');

        Route::delete('/cart/delete-product/{id}', 'Dashboard\ProductController@delete_cart');

        // Update Product Quantity from Cart
        Route::get('/cart/update-quantity/{id}/{quantity}','Dashboard\ProductController@updateCartQuantity');

        // Apply Coupon
        Route::post('/cart/apply-coupon','Dashboard\ProductController@applyCoupon');

        // Checkout Page
        Route::get('checkout-view','Dashboard\ProductController@checkout');

        Route::post('checkout','Dashboard\ProductController@docheckout');
        // Order Review Page
        Route::match(['get','post'],'/order-review','Dashboard\ProductController@orderReview');

        // Place Order
        Route::match(['get','post'],'/place-order','Dashboard\ProductController@placeOrder');


        // Users Orders Page
        Route::get('/orders','front\FrontController@userOrders');

        // User Ordered Products Page
	    Route::get('/orders/{id}','front\FrontController@userOrderDetails');

        // Paypal Page
	    Route::get('/paypal','Dashboard\PaymentController@paypal');
        Route::get('/paypal/thanks','Dashboard\PaymentController@thanksPaypal');
        Route::get('/paypal/cancel','Dashboard\PaymentController@cancelPaypal');

        // stripe page
        Route::get('/stripe','Dashboard\PaymentController@stripe');
        Route::post('/dostripe','Dashboard\PaymentController@payWithStripe')->name('payWithStripe');
        Route::get('/stripe/thanks','Dashboard\PaymentController@thanksstripe');
        Route::get('/stripe/cancel','Dashboard\PaymentController@cancelstripe');


        // Paypalsdk  Page
        Route::get('/paypal-sdk','Dashboard\PaymentController@paypalSdk');
        Route::post('/dopaypal','Dashboard\PaymentController@payWithPaypal')->name('payWithPaypalSdk');
        Route::get('/status','Dashboard\PaymentController@status');
        Route::get('/canceled','Dashboard\PaymentController@canceled');


         // Thanks Page
        Route::get('/thanks','Dashboard\ProductController@thanks');

        // search product
        Route::post('/search-products','Dashboard\ProductController@search_product')->name('search-product');

        // favorite
        Route::post('/favorite/{id}','front\FrontController@favorite')->name('favorite');
        Route::get('/favorite-products','front\FrontController@product_favorite')->name('favorite_products');


        Route::match(['get','post'],'/page/{url}','Dashboard\CmsController@cmsPage');

        // Display Contact Page
        Route::get('/contact-page','Dashboard\CmsController@contact');

        Route::post('/docontact','Dashboard\CmsController@docontact');

        Route::match(['get', 'post'],'/products/filter', 'Dashboard\ProductController@filter');

});




