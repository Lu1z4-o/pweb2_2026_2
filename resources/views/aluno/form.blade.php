@extends('main')
@section('título','Formulário de Alunos')
@section ('conteudo')
<div class="row">
    @php
    if(!empty($data->id)){
        $action = route('aluno.update', $data->id);
    }
    else{
        $action = route('aluno.store');
    }
    @endphp
    <h4>Formulário de Alunos</h4>
    <form action="{{ $action }}" method="post">
        @csrf 
        @if (!empty($data->id))
            @method('PUT')
        @endif    
        <div class="row">
            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $data->nome ?? '') }}">
            </div>
            <div class="col-6">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $data->cpf ?? '') }}">
            </div>

            <div class=" col-6">
                <label for="telefone">Telefone</label>
                <input type="number" name="telefone" class="form-control" value="{{ old('telefone', $data->telefone ?? '') }}">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{url('aluno')}}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>
@stop