<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('pages.register');
    }

    public function store(RegisterRequest $request)
    {
        $request->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'), $request->remember);
        
        return redirect()->route('home')->with('msg', 'Sikeres regisztráció!');
    }

    public function login_show()
    {
        return view('pages.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('error', 'Hibás adatok!');
        }

        return redirect()->route('home')->with('msg', 'Sikeres bejelentkezés!');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home')->with('msg', 'Sikeres kijelentkezés!');
    }
}
