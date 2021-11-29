<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminRegistrationController;
use App\Http\Controllers\Backend\FoodOrderListController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\TakeLunchController;
use App\Http\Controllers\Backend\MenuListController;

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

Route::get('/', function () {
    return view('forntendWebsite.pages.index');
})->name('welcome');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=> 'admin','as'=>'admin.'], function(){

        /**
        * Admin Dashboard
        */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        /**
         * Admin Registration
         */
        Route::resource('registration',AdminRegistrationController::class);

        /**
         * Role & Permission
         */
        Route::resource('rolePermission',RoleController::class);


        /**
         * Menu List
         */
        Route::resource('menuList',MenuListController::class);

        /**
        * Daily Food List
        */
        Route::get('daily/list', [FoodOrderListController::class, 'dailyFood'])->name('daily.food');

        /**
        * Monthly Food List
        */
        Route::get('order/list', [FoodOrderListController::class, 'orderFood'])->name('order.food');
        Route::post('filter/list', [FoodOrderListController::class, 'filterFoodOrder'])->name('filterFoodOrder');

    });

    /**
    * User Dashboard
    */
     Route::get('user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard.index');

    /**
    * Take Lunch
    */

    Route::get('user/dauly/lunch/list', [TakeLunchController::class, 'index'])->name('user.daily.lunch.index');
    Route::get('user/take/lunch', [TakeLunchController::class, 'create'])->name('user.take.lunch.create');
    Route::post('user/take/lunch', [TakeLunchController::class, 'store'])->name('user.take.lunch.store');
    Route::post('user/take/lunch/cancel/{id}', [TakeLunchController::class, 'destroy'])->name('user.take.lunch.destroy');

});


