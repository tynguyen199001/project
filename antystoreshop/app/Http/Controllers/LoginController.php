<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login()
    {
        // dd(Hash::make(123456));
        return view('login');
    }

    public function loginAdmin(Request $request)
    {
        //dd($request->all());
        $remember = $request->has('remember_me') ? true : false;
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $email = $request->email;
        $password = $request->password;

        $checkMail = User::where('email', $email)->take(1)->first();
        if ($checkMail && Hash::check($request->password, $checkMail->password)) {
            Auth::login($checkMail);
            return redirect()->route('products.index');
        } else {
            Session::flash('error_phone', 'Đăng nhập không thành công');
            return redirect()->back();
        }
    }
}
