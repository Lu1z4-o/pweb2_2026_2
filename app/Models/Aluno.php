<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Aluno extends Model
{
    use Hasfactory;
    protected $fillable =[
        'nome',
        'cpf',
        'telefone', 
        'categoria.id'
    ];

    protected $cast =[
        'categoria.id'=>'integer'
    ];

    public function categoria(){
        return $this->belongsTo(CategoriaAluno::class, 'categoria_id');
    }
}
