<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return ajax pizza lists
    public function pizzaList(Request $request){
        // logger($request->all());
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }
        else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }
}
