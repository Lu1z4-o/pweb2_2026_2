@extends('main')
@section('título','Listagem de Alunos')
@section ('conteudo')
<div class="row">
    <div class="row">
        <form action="{{route('aluno.search')}}" method="post">
            <div class="row">
                <h3> Listagem de Usuário</h3>
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="nome">Telefone</option>
                        <option value="nome">cpf</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="cpf">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{url ('aluno/create')}}" class="btn btn-success">Novo</a>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">CPF</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
            <tr>
                <th scope='row'>{{$item->id}}</th>
                <td>{{$item->nome}}</td>
                <td>{{$item->telefone}}</td>
                <td>{{$item->cpf}}</td>
                <td>
                    <a href="{{route('aluno.edit', $item->id)}}" class='btn btn-warning'>Editar</a>
                </td>

                <td>
                    <form action="{{route('aluno.destroy', $item->id)}}" method="post">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class='btn btn-danger' title='Excluir' 
                        onclick='return confirm("Deseja excluir?")'>Deletar</button>
                    </form>
                    </td>
    </tr>
        @endforeach
        </tbody>
    </table>
</div>

    @stop