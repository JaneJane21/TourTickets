<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PlanTourController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[PageController::class,'welcome'])->name('welcome');
Route::get('/catalog',[PageController::class,'catalog'])->name('catalog');

Route::get('registration',[PageController::class,'reg'])->name('reg');
Route::post('registration/save',[UserController::class,'store'])->name('store_user');

Route::get('user/logout',[UserController::class,'logout'])->name('logout');
Route::get('user/profile',[PageController::class,'profile'])->name('profile');

Route::get('auth',[PageController::class,'auth'])->name('login');
Route::post('auth/send',[UserController::class,'auth'])->name('auth');

Route::put('user/profile/update',[UserController::class,'update'])->name('update_user');

Route::post('welcome/fast_search',[PlanTourController::class,'fast_search'])->name('fast_search');

Route::get('detail/{plan?}',[PageController::class,'detail'])->name('detail');

Route::get('book/{plan?}',[PageController::class,'book'])->name('book_page');

Route::post('book/store',[BookController::class,'store'])->name('book');
Route::get('book/cancel/{book?}',[BookController::class,'destroy'])->name('cancel_book');

Route::post('welcome/review/{tour?}',[ReviewController::class,'store'])->name('store_review');

Route::post('welcome/full_search',[PlanTourController::class,'full_search'])->name('full_search');

Route::group(['middleware'=>['admin','auth'],'prefix'=>'admin'],function(){
    Route::get('/control',[AdminPageController::class,'control'])->name('control');

    Route::post('/city/save',[CityController::class,'store'])->name('store_city');
    Route::post('/location/save',[LocationController::class,'store'])->name('store_location');
    Route::post('/tour/save',[TourController::class,'store'])->name('store_tour');
    Route::post('/sale/save',[SaleController::class,'store'])->name('store_sale');
    Route::post('/plan_tour/save',[PlanTourController::class,'store'])->name('store_plan_tour');

    Route::get('/sale/delete/{sale?}',[SaleController::class,'destroy'])->name('destroy_sale');
    Route::get('/tour/delete/{tour?}',[TourController::class,'destroy'])->name('destroy_tour');
    Route::get('/location/delete/{location?}',[LocationController::class,'destroy'])->name('destroy_location');
    Route::get('/city/delete/{city?}',[CityController::class,'destroy'])->name('destroy_city');

    Route::put('/city/update/{city?}',[CityController::class,'update'])->name('update_city');
    Route::put('/location/update/{location?}',[LocationController::class,'update'])->name('update_location');
    Route::put('/sale/update/{sale?}',[SaleController::class,'update'])->name('update_sale');

    Route::get('/tour/update/{tour?}',[AdminPageController::class,'show_update_tour'])->name('show_update_tour');
    Route::put('/tour/update/save/{tour?}',[TourController::class,'update'])->name('update_tour');

    Route::post('/tour/plan/{tour?}',[PlanTourController::class,'store'])->name('plan_tour');
    Route::get('/tour/plan/cancel/{planTour?}',[PlanTourController::class,'edit'])->name('cancel_plan');
    Route::put('/tour/plan/edit/{planTour?}',[PlanTourController::class,'update'])->name('edit_plan');
    Route::get('/tour/plan/complete/{planTour?}',[PlanTourController::class,'complete'])->name('complete_plan');
});
