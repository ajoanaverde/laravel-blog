<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Symfony\Contracts\Service\Attribute\Required;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
    
        // create user
    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
        //sign in
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    
    
    
    }
}
