<?php

use Illuminate\Database\Seeder;

class ProdutosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(
            [
                'nome' => 'feijao',
                'descricao' => 'preto',
                'valor' => 5,
                'quantidade' => 100,
                'disponibilidade' => 'Sim'
            ] ,
            [
                'nome' => 'macarrao',
                'descricao' => 'parafuso',
                'valor' => 5,
                'quantidade' => 100,
                'disponibilidade' => 'Sim'
            ] ,
            [
                'nome' => 'macarrao',
                'descricao' => 'espaguete',
                'valor' => 5,
                'quantidade' => 100,
                'disponibilidade' => 'Sim'
            ] ,
            [
                'nome' => 'feijao',
                'descricao' => 'carioca',
                'valor' => 5,
                'quantidade' => 100,
                'disponibilidade' => 'Sim'
            ]
        );
    }
}
