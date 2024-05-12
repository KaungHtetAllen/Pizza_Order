<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $user = User::select('password')->where('id',$id)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            User::where('id',$id)->update([
                'password'=>Hash::make($request->newPassword)
            ]);

            // Auth::logout();
            return back()->with(['changeSuccess'=>'Password Changed ...']);
        }

        return back()->with(['notMatch'=>'The old password is wrong! Try again.']);
    }

    //direct account details page
    public function details(){
        return view('admin.account.deatails');
    }

    //direct account edit page
    public function edit(){
        return view('admin.account.edit');
    }

    // account profile update
    public function update(Request $request,$id){
        // dd($id,$request->all());
        // for storage and public folder connection => >>php artisan storage:link
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;//old image


            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();//get the request image
            $request->file('image')->storeAs('public',$fileName);//for editor storage
            $data['image'] = $fileName;//for db storage
            // dd($fileName);
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated ...']);
    }

    //get user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'gender'=> 'required',
            'address'=> 'required',
        ])->validate();
    }

    // validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required | min:8',
            'newPassword'=>'required | min:8',
            'confirmPassword'=>'required | min:8 | same:newPassword',
        ])->validate();
    }
}