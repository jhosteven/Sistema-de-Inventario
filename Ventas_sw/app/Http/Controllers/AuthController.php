<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view("modules/auth/login");
    }

    public function registro()
    {
        return view("modules/auth/registro");
    }

    public function registrar(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return to_route('login')->with('success', 'Registro exitoso, inicia sesión.');
    }

    public function logear(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return to_route('home')->with('success', 'Bienvenido.');
        } else {
            return to_route('login')->withErrors(['email' => 'Las credenciales no son correctas.']);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return to_route('login')->with('success', 'Has cerrado sesión.');
    }

    public function home()
    {
        return view('modules/dashboard/home');
    }
}
