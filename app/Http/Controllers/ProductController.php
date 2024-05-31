<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list page
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.id','desc')
        ->paginate(5);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }

    //product create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductData($request);

        //for image
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);//for editor storage
        $data['image'] = $fileName;//for db storage

        Product::create($data);
        return redirect()->route('product#list');
    }

    //product delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Deleted ...']);
    }

    //direct product view page
    public function view($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                        ->where('products.id',$id)
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->first();
        return view('admin.product.view',compact('pizza'));
    }

    //direct product edit page
    public function edit($id){
        $categories = Category::get();
        $pizza = Product::where('id',$id)->first();
        return view('admin.product.edit',compact('pizza','categories'));
    }

    //product update
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductData($request);

        //for image
        $oldImage = Product::where('id',$request->pizzaId)->first();
        $oldImage = $oldImage->image;

        if($request->hasFile('pizzaImage')){

            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }

            $newImage = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $data['image'] = $newImage;
            $request->file('pizzaImage')->storeAs('public',$newImage);

        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Product Updated ...']);
    }

    //product validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName'=>'required|unique:products,name,' . $request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ];

        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,png,jpeg|file' : 'mimes:jpg,png,jpeg|file';
        Validator::make($request->all(),$validationRules)->validate();
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
