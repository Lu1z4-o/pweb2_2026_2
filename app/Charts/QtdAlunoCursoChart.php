<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class QtdAlunoCursoChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $qtdAlunoPorCurso = DB::table('matriculas')
        ->join('curso', 'cursos.id', '=', 'matriculas.curso_id') // Join é a intersecção entre duas tabelas, ligando o id de uma ao da outra 
        ->selected('cursos.nome',DB::raw('count(1) as qtd_alunos'))
        ->groupBy('cursos.nome')
        ->orderBy('qtd_alunos', 'desc')
        ->get();

        $qtdAlunos=[];
        $nomeCursos = [];
        foreach($qtdAlunoPorCurso as $item){
            $nomeCursos[] = $item->nome;
            $qtdAlunos[] = $item->alunos->count();
        }
        
        return (new LarapexChart)->pieChart()
            ->setTitle('Cursos disponíveis')
            ->setSubtitle('Season 2021Semestre 2026.2')
            ->addData([40, 50, 30])
            ->setLabels(['TDS', 'SER', 'TI']);
    }
       
}
