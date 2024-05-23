<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return response()->json($data,200);
    }

    //
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);

        $response = [
            'status'=>'success',
            'message' => 'Add to Cart Complete!'
        ];
        return response()->json($response,200);
    }

    //get Order Data
    private function getOrderData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'quantity'=>$request->count,
        ];
    }
}
