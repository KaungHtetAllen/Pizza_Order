<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list page
    public function list(){
        $pizzas = Product::paginate(1);
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }

    //product create
    public function create(Request $request){
        $this->productValidationCheck($request);
        $data = $this->requestProductData($request);

        //for image
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);//for editor storage
        $data['image'] = $fileName;//for db storage

        Product::create($data);
        return redirect()->route('product#list');
    }

    //product validation check
    private function productValidationCheck($request){
        Validator::make($request->all(),[
            'pizzaName'=>'required|unique:products,name,',
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required',
            'pizzaImage'=>'required|mimes:jpg,png,jpeg|file',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ])->validate();
    }

    //request product data
    private function requestProductData($request){
        return [
            'name'=>$request->pizzaName,
            'category_id'=>$request->pizzaCategory,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
        ];
    }
}
