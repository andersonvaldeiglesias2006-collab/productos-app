<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra el formulario de login
    // Si el usuario ya tiene sesión activa, lo manda directo al inicio
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    // Procesa el formulario cuando el usuario hace clic en "Iniciar Sesión"
    public function login(Request $request)
    {
        // Paso 1: Valida que los campos no estén vacíos y tengan el formato correcto
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        // Paso 2: Toma solo email y password del formulario
        $credenciales = $request->only('email', 'password');

        // Paso 3: Intenta verificar las credenciales contra la base de datos
        if (Auth::attempt($credenciales)) {
            // Si las credenciales son correctas, regenera la sesión por seguridad
            $request->session()->regenerate();
            // Redirige al inicio con mensaje de bienvenida
            return redirect()->route('home')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        }

        // Si las credenciales son incorrectas, regresa al formulario con error
        // onlyInput('email') hace que el campo email recuerde lo que escribió el usuario
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();    // Destruye los datos de la sesión
        $request->session()->regenerateToken(); // Genera nuevo token CSRF
        return redirect()->route('login')->with('info', 'Ha cerrado sesión correctamente.');
    }
}