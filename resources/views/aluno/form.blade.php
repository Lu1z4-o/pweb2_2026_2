
@extends('main')

@section('titulo', 'Formulário de Alunos')

@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('aluno.update', $data->id);
            } else {
                $action = route('aluno.store');
            }
        @endphp

        <h4>Formulário de Alunos</h4>

        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">

            <div class="row">
                <div class="col-6">
                    <label for="nome">Nome</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control"
                        value="{{ old('nome', $data->nome ?? '') }}"
                    >
                </div>

                <div class="col-6">
                    <label for="cpf">CPF</label>
                    <input
                        type="text"
                        id="cpf"
                        name="cpf"
                        class="form-control"
                        value="{{ old('cpf', $data->cpf ?? '') }}"
                    >
                </div>

                <div class="col-6">
                    <label for="telefone">Telefone</label>
                    <input
                        type="text"
                        id="telefone"
                        name="telefone"
                        class="form-control"
                        value="{{ old('telefone', $data->telefone ?? '') }}"
                    >
                </div>

                <div class="col-6">
                    <label for="categoria_id">Categoria</label>
                    <select
                        name="categoria_id"
                        id="categoria_id"
                        class="form-select"
                    >
                        @foreach ($categorias as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ old('categoria_id', $data->categoria_id ?? '') == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    <label for="imagem">Imagem</label>

                    @php
                        $nome_imagem = !empty($data->imagem)
                            ? $data->imagem
                            : 'sem_imagem.jpg';
                    @endphp

                    <div class="mb-2">
                        <img
                            src="{{ asset('storage/' . $nome_imagem) }}"
                            class="rounded-circle"
                            width="200"
                            height="200"
                            alt="Imagem do aluno"
                        >
                    </div>

                    <input
                        type="file"
                        id="imagem"
                        name="imagem"
                        class="form-control"
                        accept=".png,.jpg,.jpeg"
                    >
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('aluno') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@stop
