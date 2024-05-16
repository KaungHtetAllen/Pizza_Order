<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
        });
    });


    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'], function(){
        Route::get('home',function(){
            return view('user.home');
        })->name('user#home');
    });
});


