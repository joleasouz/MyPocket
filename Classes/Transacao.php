<?php
declare(strict_types=1);

abstract class Transacao{
    private float $valor;
    private string $data;
    private string $descricao;

    public function __construct(float $valor, string $data, string $descricao){
        $this->valor = $valor;
        $this->data = $data;
        $this->descricao = $descricao;
    }

    public function getValor(): float{
        return $this->valor;
    }
 
    public function getData(): string{
        return $this->data;
    }
 
    public function getDescricao(): string{
        return $this->descricao;
    }

    abstract public function VerificarTipo(): string;
}
