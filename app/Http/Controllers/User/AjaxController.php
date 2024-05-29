<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    //
    public function order(Request $request){
        // logger($request->all());
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['product_id'],
                'quantity'=>$item['quantity'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code'],
            ]);
            $total += $item['total'];
        };
        logger($total);

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price' => $total+ 3000
        ]);

        $message = ['status'=>'true','message'=>'success'];

        return response()->json($message,200);
    }

    //clear all cart btn
    public function clearAll(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear cart btn
    public function clearCart(Request $request){
        logger($request->all());
        Cart::where('id',$request->cartId)->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();
        
        $viewCount = [
            'view_count'=> $pizza->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
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
