<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('pages.login');
    }

    public function loginPost(Request $req)
    {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password,
        ];
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            if ($user->role === 'admin') {
                return redirect('/dashboard')->with('success', 'Login Success as Admin');
            } else if ($user->role === 'user') {
                return redirect('/')->with('success', 'Login Success');
            } 
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function register(Request $req)
    {
        if ($req->isMethod('post'))
        {
            $data = $req->only( 'email');
            $data['name'] = $req->username;
            $data['password'] = bcrypt($req->password);
            if (User::create($data)) {
                return redirect('login')->with('ok', 'Tạo tài khoản thành công!');
            }
            return redirect()->back()->with('no', 'Tạo tài khoản thất bại!');
        }
        else if ($req->isMethod('get'))
        {
            return view('pages.register');
        }
    }
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }

}