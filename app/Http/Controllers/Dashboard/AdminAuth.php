<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminAuth extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }
    public function dologin(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ] );

        //$credential = ['email' => $request->email, 'password' => $request->password];

       $attempt = auth()->guard('admin')->attempt($validatedData);

        if($attempt){
            Session::flash('success', "Logged In Succefully");
            return redirect('dashboard');
        }
        else{

            Session::flash('error', "Try Login Again");
            return redirect('dashboard/login');

        }
    }
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('dashboard/login');
    }
}
