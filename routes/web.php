<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CompanyAnalystController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/',[HomeController::class,'index']);

Route::middleware('admin:admin')->group(function (){
    Route::get('admin/login',[AdminController::class, 'loginForm']);
    Route::post('admin/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('admin/home', function () {
        return view('admin.home');
    })->name('dashboard')->middleware('auth:admin');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('home/home/userpage', function () {
        $post = Post::all();
        return view('home.home.userpage', compact('post'));
    })->name('dashboard');
});


/* HOME CONTROLLER */
route::get('/redirect',[HomeController::class,'redirect']);
route::get('/product',[HomeController::class,'product']);
route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/userpage',[HomeController::class,'userpage']);
route::get('/contact',[HomeController::class,'contact']);
route::get('/productdetail/{id}',[HomeController::class,'productdetail']);
route::get('/about',[HomeController::class,'about']);
route::get('/place_order',[HomeController::class,'order']);
route::get('/payment',[HomeController::class,'payment']);
route::post('/cart/{id}',[HomeController::class,'cart']);
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
route::get('/cash_order',[HomeController::class,'cash_order']);
route::get('/card_order',[HomeController::class,'card_order']);
route::get('/view_order',[HomeController::class,'view_order']);
route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);
route::get('/blog',[HomeController::class,'blog']);

//calendar


route::get('/calendar',[ScheduleController::class,'calendar']);
route::get('/schedule',[ScheduleController::class, 'schedule']);

route::post('/schedule',[ScheduleController::class, 'add_schedule']);

route::get('/events',[ScheduleController::class,'getEvents']);
route::delete('/schedule/{id}',[ScheduleController::class,'deleteEvent']);
route::put('/schedule/{id}',[ScheduleController::class,'updateCalendar']);

route::put('/schedule/{id}/resize',[ScheduleController::class, 'resize']);
route::get('/events/search', [ScheduleController::class,'Calsearch']);





// sprint2
route::get('/create_post',[HomeController::class,'create_post'])->middleware('auth');
route::post('/user_post',[HomeController::class,'user_post'])->middleware('auth');
route::get('/my_post',[HomeController::class,'my_post'])->middleware('auth');
route::get('/my_post_delete/{id}',[HomeController::class,'my_post_delete'])->middleware('auth');
route::get('/post_update_page/{id}',[HomeController::class,'post_update_page'])->middleware('auth');
route::post('/post_update_page_data/{id}',[HomeController::class,'post_update_page_data'])->middleware('auth');


/* ADMIN CONTROLLER */

route::get('/post_page',[AdminController::class,'post_page']);
route::post('/add_post',[AdminController::class,'add_post']);
route::get('/show_post',[AdminController::class,'show_post']);
route::get('/search',[AdminController::class,'searchdata']);
route::get('/delete_post/{id}',[AdminController::class,'delete_post']);
route::get('/edit_post/{id}',[AdminController::class,'edit_post']);
route::post('/update_post/{id}',[AdminController::class,'update_post']);

route::get('/post_details/{id}',[AdminController::class,'post_details']);

//
route::get('/accept_post/{id}',[AdminController::class,'accept_post']);
route::get('/reject_post/{id}',[AdminController::class,'reject_post']);







/* CATEGORY CONTROLLER */

route::get('/view_category',[CategoryController::class,'view_category']);
route::post('/add_category',[CategoryController::class,'add_category']);
route::get('/delete_category/{id}',[CategoryController::class,'delete_category']);

/* PRODUCT CONTROLLER */

route::get('/view_product',[ProductController::class,'view_product']);
route::post('/add_product',[ProductController::class,'add_product']);
route::get('/show_product',[ProductController::class,'show_product']);
route::get('/delete_product/{id}',[ProductController::class,'delete_product']);
route::get('/edit_product/{id}',[ProductController::class,'edit_product']);
route::post('/edit_product_confirm/{id}',[ProductController::class,'edit_product_confirm']);


/* CUSTOMER CONTROLLER */

route::get('/customer_data',[CustomerController::class,'customer_data']);
route::get('/delete_customer/{id}',[CustomerController::class,'delete_customer']);

/* ORDER CONTROLLER */

route::get('/order',[OrderController::class,'order']);
route::get('/delivered/{id}',[OrderController::class,'delivered']);


/* COMPANYANALYST CONTROLLER */

route::get('/admin/home',[CompanyAnalystController::class,'company_analyst']);


