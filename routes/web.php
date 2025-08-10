<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;



//============================================================
// ROTA PRINCIPAL
//============================================================
Route::get('/', function () {
    // SE O USUÁRIO JÁ ESTIVER LOGADO, VAI PARA O DASHBOARD.
    // SENÃO, VAI PARA A PÁGINA DE LOGIN.
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

//============================================================
// ROTAS DE AUTENTICAÇÃO (PARA QUEM NÃO ESTÁ LOGADO)
//============================================================
Route::middleware('guest')->group(function () {
    // ROTA PARA MOSTRAR O FORMULÁRIO DE LOGIN
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    // ROTA PARA PROCESSAR O LOGIN
    Route::post('login', [AuthController::class, 'login']);

    // ROTA PARA MOSTRAR O FORMULÁRIO DE CADASTRO
    Route::get('cadastro', [AuthController::class, 'showRegistrationForm'])->name('cadastro');
    // ROTA PARA PROCESSAR O CADASTRO
    Route::post('cadastro', [AuthController::class, 'register']);
});

//============================================================
// ROTAS PROTEGIDAS (SÓ PARA QUEM ESTÁ LOGADO)
//============================================================
Route::middleware('auth')->group(function () {
    // ATUALIZANDO A ROTA PARA RETORNAR A VIEW DO DASHBOARD
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // ROTA PARA FAZER O LOGOUT
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    //============================================================
    // ROTAS PARA O CRUD DE CLIENTES (INDEX, CREATE, STORE, EDIT, UPDATE, DESTROY)
    Route::resource('clientes', ClienteController::class);
    //============================================================

    //============================================================
    // ROTAS PARA O CRUD DE FUNCIONÁRIOS (PROTEGIDO DENTRO DO CONTROLLER)
    Route::resource('funcionarios', FuncionarioController::class)->parameters(['funcionarios' => 'funcionario']);
    //============================================================

    //============================================================
    // ROTAS PARA O CRUD DE FORNECEDORES
    Route::resource('fornecedores', FornecedorController::class)->parameters(['fornecedores' => 'fornecedor']);
    //============================================================

    //============================================================
    // ROTAS PARA O CRUD DE SERVIÇOS
    Route::resource('servicos', ServicoController::class)->parameters(['servicos' => 'servico']);
    //============================================================

    //============================================================
    // ROTAS PARA O CRUD DE SERVIÇOS
    Route::resource('categorias', CategoriaController::class)->parameters(['categorias' => 'categoria']);
    //============================================================

});