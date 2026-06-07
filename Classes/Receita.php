<?php
declare(strict_types=1);

require_once 'Transacao.php';

class Receita extends Transacao{
    #[Override]
    public function VerificarTipo(): string{
        return "Entrada";
    }
}