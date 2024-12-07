<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('home'); 
    }
 
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.events.index'); 
            }
    
            return redirect()->route('events.index'); 
        }
    
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->withInput();
    }
    
}
