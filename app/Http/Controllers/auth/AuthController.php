<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Usuario;
use App\Models\Funcionario;

class AuthController extends Controller
{
    //============================================================
    // REGISTRO (CADASTRO)
    //============================================================

    // MOSTRA O FORMULÁRIO DE CADASTRO.
    public function showRegistrationForm()
    {
        // RETORNA A VIEW. 
        return view('auth.cadastro');
    }

    // PROCESSA O CADASTRO DO NOVO USUÁRIO.
    public function register(Request $request)
    {
        // VALIDAÇÃO DOS DADOS QUE VÊM DO FORMULÁRIO.
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:usuario',
            'password' => 'required|string|min:8|confirmed',
            'tipo' => 'required|in:admin,funcionario',
        ]);

        // CRIA O USUÁRIO NO BANCO DE DADOS.
        $usuario = Usuario::create([
            'id_usuario' => Str::random(4), // GERA UM ID ALEATÓRIO DE 4 CARACTERES.
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password), // CRIPTOGRAFA A SENHA.
            'tipo' => $request->tipo,
        ]);

        //============================================================
        // LÓGICA ADICIONADA: CRIA O FUNCIONÁRIO SE NECESSÁRIO
        //============================================================
        // SE O TIPO FOR 'FUNCIONARIO', CRIA A ENTRADA NA TABELA FUNCIONARIO.
        if ($request->tipo === 'funcionario') {
            Funcionario::create([
                'id_usuario' => $usuario->id_usuario, // USA O MESMO ID DO USUÁRIO CRIADO.
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password), // CRIPTOGRAFA A SENHA.
                'especialidade' => 'Não definida', // VALOR PADRÃO
                'salário' => 0.00, // VALOR PADRÃO
                'data_admissao' => now(), // DATA ATUAL COMO PADRÃO
            ]);
        }

        // LOGA O USUÁRIO AUTOMATICAMENTE APÓS O CADASTRO.
        Auth::login($usuario);

        // REDIRECIONA PARA O DASHBOARD.
        return redirect()->route('dashboard');
    }

    //============================================================
    // LOGIN
    //============================================================

    // MOSTRA O FORMULÁRIO DE LOGIN.
    public function showLoginForm()
    {
        // RETORNA A VIEW DE LOGIN.
        return view('auth.login');
    }

    // PROCESSA A TENTATIVA DE LOGIN.
    public function login(Request $request)
    {
        // VALIDAÇÃO DOS DADOS.
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // TENTA AUTENTICAR O USUÁRIO.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();          // REGENERA A SESSÃO POR SEGURANÇA.
            return redirect()->intended('dashboard');   // REDIRECIONA PARA O DASHBOARD.
        }

        // SE O LOGIN FALHAR, VOLTA PARA A PÁGINA DE LOGIN COM UMA MENSAGEM DE ERRO.
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    //============================================================
    // LOGOUT
    //============================================================

    // FAZ O LOGOUT DO USUÁRIO.
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // REDIRECIONA PARA A PÁGINA DE LOGIN.
        return redirect('/login');
    }
}