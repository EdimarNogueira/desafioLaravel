<?php

// tests/Feature/UserRegistrationTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase; // Isso garante que o banco de dados seja redefinido após cada teste

    /** @test */
    public function it_registers_a_new_user()
    {
        // Dados simulados de um novo usuário
        $userData = [
            'name' => 'Novo Usuário',
            'email' => 'novo_usuario@example.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ];

        // Envia uma solicitação POST para a rota de registro de usuários
        $response = $this->json('POST', '/api/register', $userData);

        // Verifica se a resposta da API é um status 201 (registro criado com sucesso)
        $response->assertStatus(201);

        // Verifica se o usuário foi inserido corretamente no banco de dados
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);

        // Verifica se a senha foi corretamente criptografada
        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }
}

