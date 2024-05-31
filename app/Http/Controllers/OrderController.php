<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function list(){
        $orders = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->orderBy('orders.created_at','desc')
                        ->get();
        return view('admin.order.list',compact('orders'));
    }

    //status ajax
    public function changeStatus(Request $request){
        // dd($request->all());
        // logger($request->all());
        // $request->status = $request->status == null ? '' : $request->status;
        $orders = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->orderBy('orders.created_at','desc');

        if ($request->orderStatus == 'null') {
            $orders = $orders->get();
        }
        else{
            $orders = $orders->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('orders'));

    }

    //ajax change status
    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update(['status'=>$request->status]);
        return response(['message'=>'success'],200);
    }

    //direct order list info page
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','products.price as product_price','products.name as product_name','products.image as product_image','users.name as user_name')
                                ->leftJoin('products','order_lists.product_id','products.id')
                                ->leftJoin('users','order_lists.user_id','users.id')
                                ->where('order_code',$orderCode)->get();
        return view('admin.order.productList',compact('orderList','order'));
    }
}
