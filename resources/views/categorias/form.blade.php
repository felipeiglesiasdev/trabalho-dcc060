@extends('layouts.dashboard')

@section('content')
    <h1>{{ isset($categoria) ? 'Editar Categoria' : 'Cadastrar Nova Categoria' }}</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($categoria) ? route('categorias.update', $categoria) : route('categorias.store') }}" method="POST">
        @csrf
        @if(isset($categoria))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" value="{{ old('marca', $categoria->marca ?? '') }}" required>
        </div>

        <button type="submit" class="btn-save">{{ isset($categoria) ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection
