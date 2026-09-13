<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\CategoriaAluno;

class AlunoController extends Controller
{
    public function index()
    {
        $dados = Aluno::All();

        return view('aluno.list', compact('dados'));
    }

    function create()
    {
        $categorias = CategoriaAluno::orderBy('nome')->get();
        return view('aluno.form')->with(compact('categorias'));
    }

    function store(Request $request)
    {
        // dd($request->all()) pega todos os dados que foram inseridos no formulário, mas ainda não salva no banco
        $this->validationForm($request);
        $data = $request->all();
        // dd($data);
        $imagem = $request->file('imagem');
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }
        Aluno::create($data);
        return redirect('aluno')->with("sucess", 'Registro salvo com sucesso!');
    }
    function validationForm(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'cpf' => 'required',
                'categoria_id=>required',
                'imagem' => 'nullable|image|mimes:png,jpg,jpeg'
            ],
            //mimes especifica os tipos de arquivo recebidos
            [
                'nome.required' => "O :attribute é obrigatório",
                'cpf.required' => "O :attribute é obrigatório",
                'categoria_id.required' => "O :attribute é obrigatório",
                'imagem.image' => "O :attribute deve ser enviado",
                'imagem.mimes' => "O :attribute deve ser das extensões: jpg, jpeg ou png",

            ],
        ); // altera a mensagem de erro original de atributos obrigatórios 
    }

    function edit($id)
    {
        $data = Aluno::find($id); // Função que habilita a edição
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form')->with(compact('data', 'categorias'));
    }

    function update(Request $request, $id) // Função que salva a edição 
    {
        $this->validationForm($request);
        $data = $request->all();
        $imagem = $request->file('imagem');
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }
        Aluno::update($data);
        return redirect('aluno')->with("sucess", 'Registro atualizado com sucesso!');
    }
    function destroy($id)
    {
        Aluno::destroy($id);
        return redirect('aluno')->with("sucess", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Aluno::All();
        }
        return view('aluno.list', compact('dados'));
    }
}
