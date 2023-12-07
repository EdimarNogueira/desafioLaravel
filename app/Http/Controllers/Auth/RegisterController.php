<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// app/Http/Controllers/Auth/RegisterController.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve ter no mínimo :3 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :50 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo :6 caracteres.',
            'password.max' => 'A senha deve ter no máximo :20 caracteres.',
            'password.confirmed' => 'A confirmação de senha não coincide.',
        ]);

        // Se a validação falhar, redirecione de volta ao formulário com os erros
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Criação do novo usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirecionamento após o registro
        return redirect('/')->with('success', 'Registro realizado com sucesso!');
    }
}
