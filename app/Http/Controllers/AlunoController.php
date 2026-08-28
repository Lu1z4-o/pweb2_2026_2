<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    public function index()
    {
        $dados = Aluno::All();

        return view('aluno.list', compact('dados'));
    }

    function create()
    {
        return view('aluno.form');
    }

    function store(Request $request)
    {
       // dd($request->all()) pega todos os dados que foram inseridos no formulário, mas ainda não salva no banco
        $this->validationForm($request); 
        Aluno::create($request->all());
        return redirect ('aluno')->with("sucess", 'Registro salvo com sucesso!');
}
    function validationForm(Request $request){
        $request->validate([
            'nome'=>'required',
            'cpf'=>'required',],
        [
            'nome.required' => "O :attribute é obrigatório",
            'cpf.required' => "O :attribute é obrigatório"
        ]); // altera a mensagem de erro original de atributos obrigatórios 
    }

      function edit($id)
    {
        $data= Aluno::find($id); // Função que habilita a edição
        return view('aluno.form', compact ('data'));
    }

    function update(Request $request, $id) // Função que salva a edição 
    {
        $this->validationForm($request); 
        Aluno::find($id)->update($request->all());
        return redirect ('aluno')->with("sucess", 'Registro atualizado com sucesso!');
}
    function destroy($id){
        Aluno::destroy($id);
        return redirect ('aluno')->with("sucess", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if(!empty($request->valor)){
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