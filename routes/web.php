<?php

use App\Http\Controllers\User\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

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

//login, register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});



Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function(){
        //category
        Route::prefix('category')->group(function(){
            Route::get('list', [CategoryController::class,'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class,'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class,'update'])->name('category#update');

        //product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create/page',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('roleChange/{id}',[AdminController::class,'roleChange'])->name('admin#roleChange');
        });
    });


    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'], function(){
        // Route::get('home',function(){
        //     return view('user.home');
        // })->name('user#home');

        //user home page
        Route::get('/homePage',[UserController::class,'home'])->name('user#home');

        //filter category
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');

        //account
        Route::prefix('account')->group(function(){
            Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('account#changePasswordPage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('account#changePassword');
            Route::get('profile',[UserController::class,'profile'])->name('account#profile');
            Route::get('edit',[UserController::class,'edit'])->name('account#edit');
            Route::post('update/{id}',[UserController::class,'update'])->name('account#update');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
        });

        //pizza
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'details'])->name('pizza#details');
        });
    });
});


