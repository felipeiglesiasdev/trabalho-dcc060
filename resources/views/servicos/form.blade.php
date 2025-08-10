@extends('layouts.dashboard')

@section('content')
    <h1>{{ isset($servico) ? 'Editar Serviço' : 'Cadastrar Novo Serviço' }}</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($servico) ? route('servicos.update', $servico) : route('servicos.store') }}" method="POST">
        @csrf
        @if(isset($servico))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" id="tipo" name="tipo" value="{{ old('tipo', $servico->tipo ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="nome">Nome do Serviço</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $servico->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" step="0.01" id="valor" name="valor" value="{{ old('valor', $servico->valor ?? '') }}" required>
        </div>

        <button type="submit" class="btn-save">{{ isset($servico) ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection
