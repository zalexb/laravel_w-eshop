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


Route::middleware(['web'])->group(function(){

    Route::get('/',['as'=>'index' ,'uses'=>'IndexController@show']);

    Route::get('/products',['uses'=>'ProductsController@show','as'=>'products']);

    Route::get('/single/{alias}',['as'=>'single','uses'=> 'ProductsController@single']);

    Route::get('/contact',['as'=>'contact' ,function () {
        return view('contact');
    }]);

    Route::get('/blog',['as'=>'blog' ,function () {

        return view('blog');
    }]);

    Route::get('/checkout',['as'=>'checkout' ,function(){

        return view('checkout');
    }]);

    Route::get('/account',['as'=>'account' ,function () {

        return view('account');
    }]);

    Route::get('/register',['as'=>'register' ,'uses'=>'UserController@show']);

    Route::post('/register',['as'=>'registration' ,'uses'=>'UserController@register']);

    Route::post('/email/check',['uses'=>'UserController@check']);

    Route::post('/search',['as'=>'search' ,'uses'=>'SearchController@liveSearch']);

    Route::get('/search/{value}',['as'=>'search_goods' ,'uses'=>'SearchController@searching']);

    Route::get('/activation/{id}/{code}',['as'=>'activation','uses'=>'UserController@activation']);

    Route::post('/login',['as'=>'login','uses'=>'UserController@login']);

    //middleware login

    Route::get('/logout',['as'=>'logout','uses'=>'UserController@logout']);

    Route::get('/{id}/profile',['as'=>'profile','uses'=>'UserController@profile']);

    Route::post('/{id}/edit',['as'=>'profile_edit','uses'=>'UserController@profile_edit']);

    //orders
    Route::post('/orderForm',['uses'=>'OrdersController@take_country']);

    Route::post('/orderForm_cities',['uses'=>'OrdersController@take_cities']);

    Route::post('/order_create',['uses'=>'OrdersController@order_create']);

    Route::get('/{id}/orders',['as'=>'orders','uses'=>'OrdersController@user_orders']);

    Route::get('/{user_id}/order/{order_id}',['as'=>'single_order','uses'=>'OrdersController@single_order']);

//reviews
    Route::post('/review_create',['uses'=>'ReviewsController@review_create']);

    Route::get('/{id}/reviews',['as'=>'reviews','uses'=>'ReviewsController@reviews']);

    Route::get('/{good_id}/rating/{rating}',['as'=>'rating','uses'=>'ReviewsController@rating']);

    Route::get('/{good_id}/favorite_add',['as'=>'favorite_add','uses'=>'ReviewsController@favorite_add']);

    Route::get('/{good_id}/favorite_delete',['as'=>'favorite_delete','uses'=>'ReviewsController@favorite_delete']);

    Route::get('/{user_id}/favorites',['as'=>'favorites','uses'=>'ReviewsController@favorites']);

    Route::get('/facebook',function () {

        return view('facebook');
    });
//fb
    Route::post('/facebook/login', 'FacebookUser@store');
    //mails
    Route::post('/mail',['uses'=>'IndexController@mail']);


});

Route::middleware(['web','admin'])->group(function(){

    Route::get('/admin',['as'=>'admin_index','uses'=>'admin\AdminController@index']);

    Route::get('/admin/goods',['as'=>'admin_goods','uses'=>'admin\AdminGoodsController@get']);

    Route::get('/admin/single/{id}',['as'=>'admin_single_good','uses'=>'admin\AdminGoodsController@single']);

    Route::post('/admin/{id}/edit',['uses'=>'admin\AdminGoodsController@edit']);

    Route::post('/admin/{id}/category',['uses'=>'admin\AdminGoodsController@category_delete']);

    Route::get('/admin/{id}/category_check',['as'=>'admin_single_category_check','uses'=>'admin\AdminGoodsController@category_check']);

    Route::post('/admin/{id}/category_add',['uses'=>'admin\AdminGoodsController@category_add']);



    Route::post('/admin/{id}/image_add',['uses'=>'admin\AdminGoodsController@image_add']);

    Route::post('/admin/{id}/image_delete',['uses'=>'admin\AdminGoodsController@image_delete']);

    Route::post('/admin/{id}/image_main_change',['uses'=>'admin\AdminGoodsController@image_main_change']);



    Route::get('/admin/order_single/{id}',['uses'=>'admin\AdminGoodsController@order_single']);

    Route::post('/admin/{id}/order_status',['uses'=>'admin\AdminGoodsController@order_status']);

    Route::match(['get','post'],'/admin/create_good',['as'=>'create_good','uses'=>'admin\AdminGoodsController@create']);

    //users
    Route::get('/admin/users',['as'=>'admin_users','uses'=>'admin\AdminUsersController@get']);

    Route::get('/admin/users_table',['uses'=>'admin\AdminUsersController@ajax_get']);

    Route::get('/admin/single_user/{id}',['as'=>'single_user','uses'=>'admin\AdminUsersController@single']);


    Route::get('/admin/single_user/order/{id}',['uses'=>'admin\AdminUsersController@order_single']);

    Route::get('/admin/favorite_single/{id}',['uses'=>'admin\AdminUsersController@favorite_single']);

    Route::post('/admin/user/{id}/edit',['uses'=>'admin\AdminUsersController@edit']);

    Route::post('/admin/user/{id}/avatar_change',['uses'=>'admin\AdminUsersController@avatar_change']);

    Route::get('/admin/user/{id}/role_check',['uses'=>'admin\AdminUsersController@role_check']);

    Route::post('/admin/user/{id}/role_add',['uses'=>'admin\AdminUsersController@role_add']);

    Route::post('/admin/user/{id}/delete_role',['uses'=>'admin\AdminUsersController@role_delete']);


    Route::post('/admin/user/{id}/favorite_delete',['uses'=>'admin\AdminUsersController@favorite_delete']);

    //orders
    Route::get('/admin/orders/{id}',['as'=>'admin_order','uses'=>'admin\AdminOrdersController@single']);

    Route::post('/admin/orders/{id}/edit',['uses'=>'admin\AdminOrdersController@edit']);

    Route::post('/admin/orders/{id}/edit_good_num',['uses'=>'admin\AdminOrdersController@edit_good_num']);

    Route::post('/admin/orders/{id}/delete_good',['uses'=>'admin\AdminOrdersController@delete_good']);

    Route::post('/admin/orders/{id}/add_good_check',['uses'=>'admin\AdminOrdersController@good_check']);

    Route::post('/admin/orders/{id}/add_order_goods',['uses'=>'admin\AdminOrdersController@add_order_goods']);

    Route::get('/admin/all_orders',['as'=>'admin_orders','uses'=>'admin\AdminOrdersController@get']);

    //reviews

    Route::get('/admin/review_single/{id}',['as'=>'admin_review','uses'=>'admin\AdminReviewsController@review_single']);

    Route::get('/admin/single_user/review/{id}',['uses'=>'admin\AdminReviewsController@review_single_user']);

    Route::post('/admin/reviews/edit_content',['uses'=>'admin\AdminReviewsController@review_edit']);

    Route::get('/admin/admin_reviews',['as'=>'admin_reviews','uses'=>'admin\AdminReviewsController@reviews_get']);

    Route::post('/admin/reviews',['uses'=>'admin\AdminReviewsController@reviews_ajax']);

    Route::post('/admin/review_delete',['uses'=>'admin\AdminReviewsController@review_delete']);

    //roles

    Route::get('/admin/roles',['as'=>'roles_list','uses'=>'admin\AdminRolesController@roles_list']);

    Route::get('/admin/add_role',['as'=>'add_role','uses'=>'admin\AdminRolesController@add_role_get']);

    Route::get('/admin/single_role/{id}',['as'=>'single_role','uses'=>'admin\AdminRolesController@single_role']);

    Route::post('/admin/add_role',['uses'=>'admin\AdminRolesController@add_role']);

    Route::post('/admin/detach_user',['uses'=>'admin\AdminRolesController@detach_user']);

    Route::post('/admin/delete_role/{id}',['uses'=>'admin\AdminRolesController@delete_role']);

    //categories

    Route::get('/admin/categories',['as'=>'categories_list','uses'=>'admin\CategoryAdminController@get_list']);

    Route::get('/admin/single_category/{id}',['as'=>'single_category','uses'=>'admin\CategoryAdminController@single']);

    Route::post('/admin/delete_category/{id}',['uses'=>'admin\CategoryAdminController@delete_category']);

    Route::get('/admin/create_category',['as'=>'create_category','uses'=>'admin\CategoryAdminController@get_create']);

    Route::post('/admin/create_category',['uses'=>'admin\CategoryAdminController@create_category']);

    //countries cities

    Route::get('/admin/countries',['as'=>'country_list','uses'=>'admin\AdminCountryCityController@country_list']);

    Route::get('/admin/single_country/{id}',['as'=>'single_country','uses'=>'admin\AdminCountryCityController@single_country']);

    Route::get('/admin/single_city/{id}',['as'=>'single_city','uses'=>'admin\AdminCountryCityController@single_city']);

    Route::get('/admin/add_country',['as'=>'add_country','uses'=>'admin\AdminCountryCityController@get_add_country']);

    Route::get('/admin/add_city',['as'=>'add_city','uses'=>'admin\AdminCountryCityController@get_add_city']);

    Route::get('/admin/order_country_city/{id}',['uses'=>'admin\AdminCountryCityController@get_orders']);

    Route::post('/admin/add_city',['uses'=>'admin\AdminCountryCityController@add_city']);

    Route::post('/admin/add_country',['uses'=>'admin\AdminCountryCityController@add_country']);

    Route::post('/admin/delete_country/{id}',['uses'=>'admin\AdminCountryCityController@delete_country']);

    Route::post('/admin/delete_city/{id}',['uses'=>'admin\AdminCountryCityController@delete_city']);

    Route::post('/admin/active_change/{id}',['uses'=>'admin\AdminCountryCityController@active_change']);


    //notifications

    Route::post('/admin/notifications',['uses'=>'admin\AdminNotificationsController@checked']);

    Route::get('/admin/notification_check',['uses'=>'admin\AdminNotificationsController@check_notifications']);

    Route::get('/admin/all_notifications',['as'=>'all_notifications','uses'=>'admin\AdminNotificationsController@all_notifications']);

    Route::get('/admin/index_activities',['uses'=>'admin\AdminController@index_activities']);


    //
    Route::get('/admin/monthly_orders',['uses'=>'admin\AdminController@monthly_orders']);

    Route::get('/admin/search/{value}',['uses'=>'admin\AdminController@search']);

    Route::post('/admin/get_mails',['uses'=>'admin\AdminMailsController@get_mails']);

    Route::post('/admin/mails_checked',['uses'=>'admin\AdminMailsController@mails_checked']);

    Route::get('/admin/inbox',['uses'=>'admin\AdminMailsController@inbox']);
});
