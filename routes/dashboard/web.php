<?php



Route::prefix('dashboard')->name('dashboard.')->group(function(){

    Config::set('auth.defines','admin');

    Route::get('login','AdminAuth@login')->name('login');

    Route::post('login','AdminAuth@dologin')->name('dologin');

    Route::group(['middleware' => 'admin:admin'],function(){

        //welcome route
        Route::get('/','WelcomeController@index')->name('index');

        //logout route
        Route::any('logout','AdminAuth@logout')->name('logout');

        // roles
        Route::resource('roles','RoleController')->except('show');;


        // admins
        Route::resource('admins','AdminController')->except('show');

        ######################### Begin user Routes ########################

        Route::resource('users', 'UserController');
        // Admin Users Charts Route
	    Route::get('/view-users-charts','UserController@viewUsersCharts')->name('users.charts');
        // Admin Users Countries Charts Route
        Route::get('/view-users-countries-charts','UserController@viewUsersCountriesCharts');
        ######################### End  user Routes  ########################


        // categories
        Route::resource('categories','CategoryController')->except(['show']);


        // coupons
        Route::resource('coupons','CouponsController')->except(['show']);


        // brands
        Route::resource('brands','BrandController')->except(['show']);

        // product

        Route::resource('products','ProductController')->except(['show']);

        // product Attributes Routes
        Route::get('products/attributes/{id}','ProductController@attribute');

        Route::post('products/add-attributes/{id}','ProductController@addAttributes')->name('addattribute');

        Route::match(['get', 'post'], 'products/edit-attributes/{id}','ProductController@editAttributes')->name('editattribute');

	    Route::delete('/products/delete-attribute/{id}','ProductController@deleteAttribute')->name('transaction.destroy');

        Route::match(['get', 'post'], 'products/product-images/{id}','ProductController@product_images');

        Route::delete('products/delete-images/{id}', 'ProductController@delete_images');

        Route::post('products/update-images/{id}','ProductController@update_images');

        // ./product Attributes Routes

        // banners route
        Route::resource('banners','BannerController')->except(['show']);

        //  orders
        Route::get('/view-orders','ProductController@viewOrders')->name('viewOrders');

        Route::get('/view-order/{id}','ProductController@viewOrderDetails')->name('viewOrdersDetails');

        Route::get('/view-orders-charts','ProductController@viewOrdersCharts')->name('viewOrderCharts');

        // Order Invoice
        Route::get('/view-order-invoice/{id}','ProductController@viewOrderInvoice');

        // Update Order Status
        Route::post('/update-order-status','ProductController@updateOrderStatus');

        // cms pages
        Route::resource('cmsPages','CmsController')->except(['show']);

     });


});