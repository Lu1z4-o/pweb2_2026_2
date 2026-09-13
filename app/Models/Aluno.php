<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use Hasfactory;
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'categoria_id',
        'imagem'
    ];
    // Valores que não são string são inseridos no cast 
    protected $cast = [
        'categoria_id' => 'integer',
        'imagem' => 'img'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaAluno::class, 'categoria_id');
    }
}
