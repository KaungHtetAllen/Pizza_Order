<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('product/list',[RouteController::class,'productList']); //READ PRODUCTS
Route::get('category/list',[RouteController::class,'categoryList']); //READ CATEGORIES
Route::get('contact/list',[RouteController::class,'contactList']); //READ CONTACTS
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']); //DELETE CATEGORY
Route::get('category/list/{id}',[RouteController::class,'categoryDetails']); //READ CATEGORY



//POST
Route::post('category/create',[RouteController::class,'categoryCreate']); //CREATE CATEGORY
Route::post('contact/create',[RouteController::class,'contactCreate']); //CREATE CONTACT
Route::post('category/update',[RouteController::class,'categoryUpdate']); //UPDATE CATEGORY
// Route::post('category/delete',[RouteController::class,'categoryDelete']);

