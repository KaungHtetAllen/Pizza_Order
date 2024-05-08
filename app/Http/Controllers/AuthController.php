<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login page
    public function loginPage(){
        return view('login');
    }

    //direct register page
    public function registerPage(){
        return view('register');
    }

    //dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        else{
            return redirect()->route('user#home');
        }
    }

    //direct change password page
    public function changePasswordPage(){
        return view('admin.password.changePassword');
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

    // validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required | min:8',
            'newPassword'=>'required | min:8',
            'confirmPassword'=>'required | min:8 | same:newPassword',
        ])->validate();
    }
}
