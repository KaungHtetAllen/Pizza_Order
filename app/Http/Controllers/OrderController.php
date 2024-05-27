<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        if ($request->orderStatus == null) {
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
}
