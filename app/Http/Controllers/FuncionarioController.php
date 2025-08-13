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
            'especialidade' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
        ]);


        // USA UMA TRANSAÇÃO PARA GARANTIR QUE OS DOIS REGISTROS SEJAM CRIADOS COM SUCESSO.
        DB::transaction(function () use ($request) {

            //============================================================
            // LÓGICA PARA GERAR UM ID NUMÉRICO ÚNICO
            //============================================================
            $idUsuario = null;
            do {
                // GERA UM NÚMERO ALEATÓRIO DE 0 A 9999 E PREENCHE COM ZEROS À ESQUERDA PARA TER 4 DÍGITOS.
                $idUsuario = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (Usuario::find($idUsuario)); // VERIFICA SE O ID JÁ EXISTE NO BANCO.

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
                'salario' => $request->salario,
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
            'nome' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuario')->ignore($funcionario->id_usuario, 'id_usuario')],
            'especialidade' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
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
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'especialidade' => $request->especialidade,
                    'salario' => $request->salario,
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
        // USA O RELACIONAMENTO PARA VERIFICAR SE EXISTEM REGISTROS ASSOCIADOS.
        // O MÉTODO 'EXISTS()' É MAIS EFICIENTE QUE 'COUNT() > 0'.
        $temOrdensDeServico = $funcionario->funcionario->ordemServicos()->exists();
        $temVendas = $funcionario->funcionario->vendas()->exists();
        
        // VERIFICA SE O FUNCIONÁRIO TEM ALGUMA LIGAÇÃO.
        if ($temOrdensDeServico || $temVendas) {
            // SE TIVER, RETORNA PARA A PÁGINA ANTERIOR COM UMA MENSAGEM DE ERRO.
            return redirect()->route('funcionarios.index')
                             ->with('error', 'Não é possível excluir este funcionário, pois ele está associado a ordens de serviço ou vendas.');
        }

        // SE NÃO HOUVER LIGAÇÕES, PROSSEGUE COM A EXCLUSÃO.
        DB::transaction(function () use ($funcionario) {
            // DELETA PRIMEIRO O REGISTRO 'FILHO' NA TABELA FUNCIONARIO.
            if ($funcionario->funcionario) {
                $funcionario->funcionario->delete();
            }
            // DEPOIS DELETA O REGISTRO 'PAI' NA TABELA USUARIO.
            $funcionario->delete();
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}