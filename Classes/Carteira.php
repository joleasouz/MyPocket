<?php
declare(strict_types=1);

require_once 'Receita.php';
require_once 'Despesa.php';

class Carteira{
    private float $saldo = 0;
    private array $transacoes = [];

    public function adicionarReceita(Receita $receita){
        $this->saldo += $receita->getValor();
        $this->transacoes[] = $receita;
    }

    public function adicionarDespesa(Despesa $despesa){
        if($despesa->getValor() > $this->saldo){
            throw new Exception("Não é possível cadastrar uma despesa maior que o saldo.");
        }
        else{
            $this->saldo -= $despesa->getValor();
            $this->transacoes[] = $despesa;
        }
    }

    public function getSaldo(): float{
        return $this->saldo;
    }

    public function getTransacoes(): array{
        return $this->transacoes;
    }
}