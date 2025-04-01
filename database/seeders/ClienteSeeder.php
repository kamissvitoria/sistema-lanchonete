<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cpfsUsados = collect();  // Coleção para armazenar CPFs gerados e evitar duplicação

        for ($i = 0; $i <= 400; $i++) {
            $ano = rand(1990, 2005);
            $mes = rand(1, 12);
            $dia = rand(1, 28);

            $enderecos = collect([
                'Rua das Flores, 123', 'Avenida Paulista, 1000', 'Rua do Sol, 45', 
                'Avenida Rio Branco, 303', 'Rua dos Três Irmãos, 100'
            ]);
            
            $telefones = collect([
                '11 98765-4321', '21 99123-4567', '31 99876-1234', '41 99999-8888', '51 93012-3456'
            ]);

            // Gerar CPF único
            do {
                $cpf = str_pad(rand(100000000, 999999999), 11, '0', STR_PAD_LEFT); // CPF sem pontos e hífens
            } while ($cpfsUsados->contains($cpf));  // Verificar se o CPF já foi gerado
            
            $cpfsUsados->push($cpf); // Adicionar o CPF gerado à coleção

            // Criar cliente
            $clientes = [
                'nome' => 'Cliente ' . $i,
                'email' => 'cliente' . $i . '@exemplo.com',
                'telefone' => $telefones->random(),
                'cpf' => $cpf,
                'endereco' => $enderecos->random(),
                'password' => 'senha123', 
            ];

            Cliente::create($clientes);
        }
    }
}
