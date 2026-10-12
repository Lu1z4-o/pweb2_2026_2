<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\CategoriaAluno;

class AlunoController extends Controller
{
    public function index()
    {
        $dados = Aluno::all();

        return view('aluno.list')->with(['dados' => $dados]);
    }

    public function create()
    {
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form')->with(compact('categorias'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg',
        ], [
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
            'categoria_id.required' => 'O :attribute é obrigatório',
            'imagem.image' => 'O :attribute deve ser uma imagem válida',
            'imagem.mimes' => 'A imagem deve ter extensão PNG, JPEG ou JPG',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . '.' .
                $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/aluno/';

            $imagem->storeAs($diretorio, $nome_imagem, 'public');

            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Aluno::create($data);

        return redirect('aluno')->with(
            'success',
            'Registro salvo com sucesso!'
        );
    }

    public function edit($id)
    {
        $data = Aluno::findOrFail($id);
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form')->with(compact('data', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . '.' .
                $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/aluno/';

            $imagem->storeAs($diretorio, $nome_imagem, 'public');

            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Aluno::findOrFail($id)->update($data);

        return redirect('aluno')->with(
            'success',
            'Registro atualizado com sucesso!'
        );
    }

    public function destroy($id)
    {
        Aluno::destroy($id);

        return redirect('aluno')->with(
            'success',
            'Registro removido com sucesso!'
        );
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%{$request->valor}%"
            )->get();
        } else {
            $dados = Aluno::all();
        }

        return view('aluno.list', compact('dados'));
    }
}