<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{

    //============================================================
    // LISTAR TODOS OS FUNCIONÁRIOS (READ)
    //============================================================
    public function index()
    {
        // BUSCA TODOS OS USUÁRIOS QUE SÃO DO TIPO 'FUNCIONARIO'.
        $funcionarios = Usuario::where('tipo', 'funcionario')->get();
        return view('funcionarios.index', compact('funcionarios'));
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE)
    //============================================================
    public function create()
    {
        return view('funcionarios.form');
    }

    //============================================================
    // ARMAZENAR NOVO FUNCIONÁRIO (CREATE)
    //============================================================
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario',
            'password' => 'required|string|min:1|confirmed',
            'especialidade' => 'required|string|max:30',
            'salário' => 'required|numeric|min:0',
        ]);

        // USA UMA TRANSAÇÃO PARA GARANTIR QUE OS DOIS REGISTROS SEJAM CRIADOS COM SUCESSO.
        DB::transaction(function () use ($request) {
            $idUsuario = Str::random(4);

            // 1. CRIA O REGISTRO NA TABELA 'USUARIO'.
            $usuario = Usuario::create([
                'id_usuario' => $idUsuario,
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo' => 'funcionario', // SEMPRE SERÁ FUNCIONÁRIO AQUI.
            ]);

            // 2. CRIA O REGISTRO NA TABELA 'FUNCIONARIO'.
            Funcionario::create([
                'id_usuario' => $idUsuario,
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'especialidade' => $request->especialidade,
                'salário' => $request->salário,
                'data_admissao' => now(),
            ]);
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE EDIÇÃO (UPDATE)
    //============================================================
    public function edit(Usuario $funcionario) // RECEBE O USUÁRIO A SER EDITADO
    {
        // CARREGA OS DADOS DO FUNCIONÁRIO ASSOCIADO AO USUÁRIO.
        $funcionario->load('funcionario');
        return view('funcionarios.form', compact('funcionario'));
    }

    //============================================================
    // ATUALIZAR FUNCIONÁRIO (UPDATE)
    //============================================================
    public function update(Request $request, Usuario $funcionario)
    {
        $request->validate([
            'nome' => 'required|string|max:10',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuario')->ignore($funcionario->id_usuario, 'id_usuario')],
            'especialidade' => 'required|string|max:30',
            'salário' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $funcionario) {
            // 1. ATUALIZA OS DADOS NA TABELA 'USUARIO'.
            $funcionario->update([
                'nome' => $request->nome,
                'email' => $request->email,
            ]);

            // 2. ATUALIZA OS DADOS NA TABELA 'FUNCIONARIO'.
            if ($funcionario->funcionario) {
                $funcionario->funcionario->update([
                    'especialidade' => $request->especialidade,
                    'salário' => $request->salário,
                ]);
            }
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    //============================================================
    // EXCLUIR FUNCIONÁRIO (DELETE)
    //============================================================
    public function destroy(Usuario $funcionario)
    {
        DB::transaction(function () use ($funcionario) {
            // COMO A CHAVE ESTRANGEIRA ESTÁ EM 'FUNCIONARIO', PRECISAMOS DELETAR ELE PRIMEIRO.
            if ($funcionario->funcionario) {
                $funcionario->funcionario->delete();
            }
            // DEPOIS DELETAMOS O USUÁRIO.
            $funcionario->delete();
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}