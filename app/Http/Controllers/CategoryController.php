<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::when(request('key'), function($query){
            $query->where('name','like','%'.request('key').'%');
        })->orderBy('id','asc')->paginate(5);
        return view('admin.category.list', compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category Created ...']);
    }

    //delete category
    public function delete($id){
        // dd($id);
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted ...']);
    }

    //direct category edit page
    public function edit($id){
        // dd($id);
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function update(Request $request){
        // dd($request->all());
        $id = $request->categoryId;
        $this->updateCategoryValidationCheck($request,$id);
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Category Updated ...']);
    }

    //create category validation check (Private)
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name'
        ])->validate();
    }

    //update category validation check (Private)
    private function updateCategoryValidationCheck($request,$id){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$id
        ])->validate();
    }

    //request category data (Private)
    private function requestCategoryData($request){
        return [
            'name'=>$request->categoryName
        ];
    }
}
