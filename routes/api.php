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

//Category
Route::get('category/list',[RouteController::class,'categoryList']); //READ CATEGORIES
Route::post('category/create',[RouteController::class,'categoryCreate']); //CREATE CATEGORY
Route::get('category/list/{id}',[RouteController::class,'categoryDetails']); //READ CATEGORY
Route::post('category/update',[RouteController::class,'categoryUpdate']); //UPDATE CATEGORY
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']); //DELETE CATEGORY
// Route::post('category/delete',[RouteController::class,'categoryDelete']);


//Product
Route::get('product/list',[RouteController::class,'productList']); //READ PRODUCTS


//Contact
Route::get('contact/list',[RouteController::class,'contactList']); //READ CONTACTS
Route::post('contact/create',[RouteController::class,'contactCreate']); //CREATE CONTACT
Route::get('contact/delete/{id}',[RouteController::class,'contactDelete']);





//Post Man

/*
product lists
=>localhost:8000/api/product/list(GET)

category lists
=>localhost:8000/api/category/list(GET)

category list individual detail
=>localhost:8000/api/category/list/{id}(GET)

create category
=>localhost:8000/api/category/create(POST)
key=>name

update category
=>localhost:8000/api/category/update(POST)
key=>category_id,category_name

delete category
=>localhost:8000/api/category/delete/{id} (GET)

contact lists
=>localhost:8000/api/contact/list(GET)

contact create
=>localhost:8000/api/contact/create(POST)
key=>name,email,message

contact delete
=>localhost:8000/api/contact/delete/{id}(GET)

*/
