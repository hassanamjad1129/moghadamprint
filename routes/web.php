<?php

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

use App\option;

Route::get('/', function (\Illuminate\Http\Request $request) {
    $welcome = 0;
    if (!$request->session()->has('welcome')) {
        $request->session()->put('welcome', 1);
        $welcome = 1;
    }
    $slideshows = \App\slideshow::where('category_id', 15)->get();
    $popup = option::find('popup')->option_value;

    return view('welcome', ['welcome' => $welcome, 'slideshows' => $slideshows, 'popup' => $popup]);
});

Route::post('/', function (\Illuminate\Http\Request $request) {
    $url = "37.130.202.188/services.jspd";
    $rcpt_nm = ($request->to_number);
    $param = array
    (
        'uname' => 'مقدم چاپ',
        'pass' => '22501792',
        'from' => '100020400',
        'message' => "مجتمع چاپ مقدم\nبا عرض سلام\n" . $request->to_name . " عزیز شما از طرف همکار گرامی " . $request->from_name . " به سامانه سفارش آنلاین مجتمع مقدم چاپ دعوت شده اید\nبه همین منظور هدیه مجتمع به شما یک فرم کارت ویزیت گلاسه دورو می باشد\nبه خانواده بزرگ مقدم چاپ خوش آمدید.\nمجتمع چاپ مقدم اولین و تنها چاپخانه با ارسال رایگان در تهران\nwww.moghadamprint.com\n02126329518",
        'to' => json_encode($rcpt_nm),
        'op' => 'send'
    );

    $handler = curl_init($url);
    curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($handler);

    $response2 = json_decode($response2);
    $res_code = $response2[0];
    $res_data = $response2[1];
    return redirect()->back()->withErrors(['پیامک معرفی ارسال شد'], 'success');

});
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('representations', 'HomeController@representations');
Route::get('contact-us', 'HomeController@contactus');
Route::get('about-us', 'HomeController@aboutus');
Route::get('pre-order', 'HomeController@preorder');
Route::get('policies', 'HomeController@policies');
Route::get('لیست-قیمت/{category}', 'HomeController@priceList')->name('customer.priceList');


Route::get('catalog', 'HomeController@catalog');
Route::get('digitalMarketing', 'HomeController@digitalMarketing');
Route::get('envlope', 'HomeController@envlope');
Route::get('fantasy', 'HomeController@fantasy');
Route::get('formatedforms', 'HomeController@formatedforms');
Route::get('genius', 'HomeController@genius');
Route::get('header', 'HomeController@header');
Route::get('ledBoard', 'HomeController@ledBoard');
Route::get('machinesPrice', 'HomeController@machinesPrice');
Route::get('poster', 'HomeController@poster');
Route::get('promotionalGifts', 'HomeController@promotionalGifts');
Route::get('tracket', 'HomeController@tracket');
Route::get('visitCard', 'HomeController@visitCard');
Route::get('riso', 'HomeController@riso');


Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'customer', 'namespace' => 'customer', 'middleware' => 'customerMiddleware'], function () {

    Route::get('/', 'homeController@dashboard')->name('customerDashboard');
    Route::patch('/', 'homeController@updateProfile');
    Route::post('/getSubCategories', 'homeController@getSubCategories')->name('getSubCategories');
    Route::post('/fetchProducts', 'homeController@fetchProducts')->name('admin.fetchProducts');
    Route::post('/fetchProductInformation', 'homeController@fetchProductInformation')->name('admin.fetchProductInformation');
    Route::post('/getFiles', 'homeController@getFiles')->name('admin.getFiles');
    Route::post('/checkFile', 'homeController@checkFile')->name('admin.checkFile');

    Route::get('/moneybag/increase', 'moneybagController@increase')->name('customer.moneybag.increase');
    Route::post('/moneybag/increase', 'moneybagController@doPayment');
    Route::get('/moneybag/verifyPayment', 'moneybagController@verifyPayment')->name('customer.moneybag.verifyPayment');
    Route::get('/moneybag/logs', 'moneybagController@index')->name('customer.moneybag.index');
    Route::get('inProgressOrders', 'orderController@inCompleteOrders')->name('customer.inCompleteOrders');
    Route::get('orders', 'orderController@completedOrders')->name('customer.completedOrders');
    Route::post('orders', 'orderController@completedOrders');
    Route::get('order/{order}/detail', 'orderController@orderDetail')->name('customer.order.detail');

    Route::get('downloads/', 'downloadController@index')->name('customer.downloads');
    Route::get('/downloads/file/{download}', 'downloadController@downloadFile')->name('customer.downloads.file');

    Route::get('gallery', 'galleryController@index')->name('customer.galleries');
    Route::get('gallery/{category}', 'galleryController@pictures')->name('customer.gallery.pictures');

    Route::get('/order', 'orderController@create')->name('customer.order');
    Route::post('/order', 'orderController@store');
    Route::get('/cart', 'orderController@cart')->name('customer.cart');
    Route::post('/cart', 'orderController@finalStep');
    Route::post('/finalStep', 'orderController@storeOrder')->name('customer.storeOrder');
    Route::post('/verifyOrder', 'orderController@verifyOrder')->name('customer.verifyOrder');
    Route::get('/cart/{id}/remove', 'orderController@removeCart')->name('customer.removeCart');

    Route::get('order/verifyPayment', 'orderController@verifyPayment')->name('customer.verifyOrder');

    Route::get('/stateCity', 'stateCityController@index')->name('customer.state.city');
    Route::post('/stateCity/city/ajax', 'stateCityController@cityAjax')->name('customer.city.ajax');
    //Route::post('/stateCity/sendMethod/ajax','stateCityController@sendMethodAjax')->name('customer.sendMethod.ajax');
    Route::post('/stateCity', 'stateCityController@store')->name('customer.orderStateCity.store');
    Route::get('/factor/{orderItem}', 'orderController@getFactor')->name('customer.orders.getFactor');


    Route::get('reportOrders', 'orderController@orders')->name('customer.reportOrders');
    Route::post('reportOrders', 'orderController@orders')->name('customer.reportOrders');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'adminMiddleware'], function () {
    Route::get('/', 'homeController@dashboard')->name('adminDashboard');
    Route::post('/', 'homeController@updateProfile');
    Route::post('/fetchSubCategories', 'homeController@fetchSubCategories')->name('admin.fetchSubCategories');

    Route::post('/checkOrders', 'homeController@checkOrders')->name('admin.checkOrders');
    Route::post('/checkUsers', 'homeController@checkUsers')->name('admin.checkUsers');
    Route::post('/checkTickets', 'homeController@checkTickets')->name('admin.checkTickets');

    Route::post('/seenNotification', 'homeController@seenNotification')->name('admin.seenNotification');

    Route::resource('categories', 'categoryController');
    Route::resource('subCategories', 'subCategoriesController');
    Route::resource('benefits', 'benefitController');

    Route::get('subCategories/files/{subCategory}', 'subCategoriesController@files')->name('admin.subCategory.files');
    Route::get('subCategories/files/{subCategory}/create', 'subCategoriesController@createFiles')->name('admin.subCategory.createFile');
    Route::post('subCategories/files/{subCategory}', 'subCategoriesController@storeFiles')->name('admin.subCategory.storeFiles');
    Route::get('subCategories/files/{subCategory}/edit/{file}', 'subCategoriesController@editFiles')->name('admin.subCategory.editFile');
    Route::post('subCategories/files/{subCategory}/edit/{file}', 'subCategoriesController@updateFiles')->name('admin.subCategory.updateFiles');
    Route::get('subCategories/files/{subCategory}/destroy/{file}', 'subCategoriesController@deleteFiles')->name('admin.subCategory.deleteFile');


    Route::resource('products', 'productsController');

    Route::get('customers/notVerified', 'customerController@notVerified')->name('admin.customers.notVerified');
    Route::get('customers/signup', 'customerController@signup');
    Route::post('customers/signup', 'customerController@storeUser');
    Route::resource('customers', 'customerController');

    Route::get('customers/{customer}/orders', 'customerController@orders')->name('admin.customers.orders');
    Route::post('customers/{customer}/orders', 'customerController@orders');
    Route::get('customers/{customer}/moneybag', 'customerController@moneybag')->name('admin.customers.moneybag');
    Route::post('customers/{customer}/moneybag', 'customerController@storeMoneyBag');
    Route::get('customers/{customer}/unblock', 'customerController@unblock')->name('admin.customers.unblock');
    Route::get('customers/{customer}/setRepresentation', 'customerController@setRepresentation')->name('admin.customers.setRepresentation');
    Route::get('customers/{customer}/loginToPanel', 'customerController@loginToUserAccount')->name('admin.customers.loginToUserAccount');
    Route::post('customers/{customer}/storeRepresentation', 'customerController@storeRepresentation')->name('admin.customers.storeRepresentation');
    Route::post('customers/sendMessage', 'customerController@sendMessage')->name('admin.customers.sendMessage');
    Route::get('customers/{customer}/setCustomer', 'customerController@setCustomer')->name('admin.customers.setCustomer');
    Route::get('customers/{customer}/delete', 'customerController@deleteUser')->name('admin.customers.deleteCustomer');

    Route::resource('shippings', 'shippingController');
    Route::get('shippings/{shipping}/restore', 'shippingController@restore')->name('shippings.restore');

    Route::resource('downloads', 'downloadController');
    Route::get('downloads/file/{download}', 'downloadController@downloadFile')->name('admin.downloads.file');
    Route::get('downloadCategories', 'downloadController@categories')->name('admin.downloads.categories');
    Route::get('downloadCategories/create', 'downloadController@createCategory')->name('admin.downloads.createCategory');
    Route::post('downloadCategories/create', 'downloadController@storeCategory');
    Route::get('downloadCategories/{category}/edit', 'downloadController@editCategory')->name('admin.downloads.editCategory');
    Route::patch('downloadCategories/{category}/edit', 'downloadController@updateCategory')->name('admin.downloads.updateCategory');
    Route::get('downloadCategories/{category}/delete', 'downloadController@deleteCategory')->name('admin.downloads.deleteCategory');

    Route::get('orders/incomplete', 'orderController@inCompleteOrders')->name('admin.orders.incomplete');
    Route::get('orders/complete', 'orderController@completedOrders')->name('admin.orders.completedOrders');
    Route::get('order/{order}/detail', 'orderController@orderDetail')->name('admin.order.detail');
    Route::post('order/{order}/detail', 'orderController@updateOrderDetail');
    Route::get('order/{order}/cancel', 'orderController@cancelOrder')->name('admin.order.cancelOrder');

    Route::get('groupMessage', 'customerController@sendGroupMessage')->name('groupMessage');
    Route::post('groupMessage', 'customerController@sendMessageToAll');

    Route::get('priceLists', 'priceListController@index')->name('admin.priceLists');
    Route::post('priceLists', 'priceListController@updateList')->name('admin.updateList');

    Route::get('parentSlideshows', 'slideshowController@index')->name('admin.slideshows');
    Route::get('slideshows/{category}', 'slideshowController@management')->name('admin.slideshowManagement');

    Route::get('slideshows/{slide}/remove', 'slideshowController@remove')->name('admin.slideshow.remove');
    Route::get('slideshows/{slide}/edit', 'slideshowController@edit')->name('admin.slideshow.edit');
    Route::patch('slideshows/{slide}', 'slideshowController@update')->name('admin.slideshow.update');

    Route::get('slideshows/{category}/create', 'slideshowController@create')->name('admin.slideshow.create');
    Route::post('slideshows/{category}/create', 'slideshowController@store')->name('admin.slideshow.store');

    Route::get('services', 'serviceController@index')->name('admin.services.index');
    Route::get('services/create', 'serviceController@create')->name('admin.services.create');
    Route::post('services/create', 'serviceController@store')->name('admin.services.store');
    Route::get('services/{service}/edit', 'serviceController@edit')->name('admin.services.edit');
    Route::patch('services/{service}/edit', 'serviceController@update')->name('admin.services.update');
    Route::delete('services/{services}', 'serviceController@destroy')->name('admin.services.destroy');

    Route::get('options', 'optionController@index');
    Route::post('options', 'optionController@update');

    Route::get('galleryCategory/create', 'galleryController@createCategory')->name('admin.galleryCategory.create');
    Route::post('galleryCategory', 'galleryController@storeCategory')->name('admin.galleryCategory.store');
    Route::get('galleryCategory/edit/{category}', 'galleryController@editCategory')->name('admin.galleryCategory.edit');
    Route::post('galleryCategory/edit/{category}', 'galleryController@updateCategory')->name('admin.galleryCategory.update');
    Route::get('galleryCategory/destroy/{category}', 'galleryController@destroyCategory')->name('admin.galleryCategory.destroy');
    Route::get('galleryCategory', 'galleryController@indexCategory')->name('admin.galleryCategory.index');


    Route::get('gallery/create', 'galleryController@create')->name('admin.gallery.create');
    Route::post('gallery', 'galleryController@store')->name('admin.gallery.store');
    Route::get('gallery/edit/{gallery}', 'galleryController@edit')->name('admin.gallery.edit');
    Route::post('gallery/edit/{gallery}', 'galleryController@update')->name('admin.gallery.update');
    Route::get('gallery/destroy/{gallery}', 'galleryController@destroy')->name('admin.gallery.destroy');
    Route::get('gallery', 'galleryController@index')->name('admin.gallery.index');

    Route::get('sendMethod', 'sendMethodController@index')->name('admin.sendMethod.index');
    Route::get('sendMethod/create', 'sendMethodController@create')->name('admin.sendMethod.create');
    Route::post('sendMethod/create', 'sendMethodController@store')->name('admin.sendMethod.store');
//     Route::post('sendMethod/city/ajax','sendMethodController@cityAjax')->name('admin.sendMethod.city.ajax');
//     Route::post('sendMethod/show/ajax','sendMethodController@showAjax')->name('admin.sendMethod.show.ajax');
    Route::get('sendMethod/{sendMethod}/edit', 'sendMethodController@edit')->name('admin.sendMethod.edit');
    Route::patch('sendMethod/{sendMethod}/edit', 'sendMethodController@update')->name('admin.sendMethod.update');
    Route::delete('sendMethod/{sendMethod}/delete', 'sendMethodController@delete')->name('admin.sendMethod.delete');

    Route::get('deliverie/{type?}', 'deliverieController@index')->name('admin.deliverie.index');
    Route::get('deliverie/{deliverie}/detail', 'deliverieController@detailDeliverie')->name('admin.deliverie.detail');
    Route::get('deliverie/{deliverie}/accept', 'deliverieController@accept')->name('admin.deliverie.accept');
});

/**
 * Filemanager Routes
 */
Route::group(['middleware' => 'adminMiddleware'], function () {
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');

});