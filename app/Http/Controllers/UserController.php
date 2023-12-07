<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
            'password.confirmed' => 'A confirmação de senha não coincide.',
        ]);

        // Se a validação falhar, retorne uma resposta JSON com erros
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Criação do novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Se o usuário foi criado com sucesso, retorne uma resposta JSON de sucesso
        if ($user) {
            return response()->json(['message' => 'Usuário registrado com sucesso'], 201);
        }

        // Se ocorreu um erro ao criar o usuário, retorne uma resposta JSON com erro
        return response()->json(['message' => 'Erro ao registrar usuário'], 500);
    }
}
