<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get product list data
    public function productList(){
        $products = Product::get();
        return response()->json($products,200);
    }

    //get category list data
    public function categoryList(){
        $categories = Category::get();
        return response()->json($categories,200);
    }

    //category create
    public function categoryCreate(Request $request){
        $data = [
            'name'=> $request->name
        ];

        $response = Category::create($data);
        return response()->json($response,200);
    }

    //contact create
    public function contactCreate(Request $request){
        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
        ];

        $response = Contact::create($data);
        return response()->json($response,200);
    }

    //contact list
    public function contactList(){
        $contacts = Contact::get();
        return response()->json($contacts,200);
    }

    //category delete
    // public function categoryDelete(Request $request){
    //     $data = Category::where('id',$request->category_id)->first();

    //     if(isset($data)){
    //         Category::where('id',$request->category_id)->delete();
    //         return response()->json(['status'=>'true','message'=>'Success'],200);
    //     }
    //     else{
    //         return response()->json(['status'=>'false','message'=>'No Data!'],200);
    //     }
    // }

    public function categoryDelete($id){
        $data = Category::where('id',$id)->first();

         if(isset($data)){
             Category::where('id',$id)->delete();
             return response()->json(['status'=>'true','message'=>'Success','deletedData'=>$data],200);
         }
         else{
             return response()->json(['status'=>'false','message'=>'No Data!'],200);
         }
    }

    //category details
    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();

         if(isset($data)){
             return response()->json(['status'=>'true','message'=>'Success','data'=>$data],200);
         }
         else{
             return response()->json(['status'=>'false','message'=>'No Data!'],404);
         }
    }

    //category update
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;
        $data = [
            'name'=>$request->category_name
        ];

        $dbSource = Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['status'=>'true','message'=>'Category Updated!','data'=>$response],200);
        }
        else{
            return response()->json(['status'=>'false','message'=>'Not Found!'],404);
        }
    }
}
