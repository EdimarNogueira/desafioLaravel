<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app') 

@section('content')
    <!-- Exibição de Erros de Validação -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de Registro de Usuário -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campo Nome -->
        <div>
            <label for="name">Nome:</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" minlength="3" maxlength="50">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo E-mail -->
        <div>
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Senha -->
        <div>
            <label for="password">Senha:</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" minlength="6" maxlength="20">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Confirmação de Senha -->
        <div>
            <label for="password_confirmation">Confirme a Senha:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Botão de Registro -->
        <div>
            <button type="submit">Registrar</button>
        </div>
    </form>
@endsection
