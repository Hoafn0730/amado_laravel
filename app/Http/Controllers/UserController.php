<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.pages.user.show', ['users'=> $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            User::create([

                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
            ]);
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Throwable $th) {
            //throw $th;
            return  redirect('/users')->withErrors('Thông tin bạn nhập đã tồn tại!'); 
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.edit', ['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            User::find($id)->update([ 
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
                "remember_token" => $request->remember_token,
            ]);
            
            return  redirect('/users')
            ->with('success', 'Sửa thành công');
        } catch (\Throwable $th) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'); 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()
            ->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return  redirect()->back()->withErrors('data is not exist!'); 
        }
        
    }
}