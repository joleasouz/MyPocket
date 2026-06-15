<?php
require_once 'Classes/Carteira.php';
session_start();

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
} else {
    $mensagem = null;
}

if (!isset($_SESSION['carteira'])) {
    $_SESSION['carteira'] = new Carteira();
}

$carteira = $_SESSION['carteira'];
$saldo     = $carteira->getSaldo();
$historico = $carteira->getTransacoes();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPocket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php if ($mensagem): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <div class=saldo>
        <div class="card text-white bg-primary mb-4">
            <div class="card-body">
                <h5 class="card-title">Saldo disponível</h5>
                <h2>R$ <?= number_format($saldo, 2, ',', '.') ?></h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="formulario">
                    <form action="processa.php" method="POST">
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor: </label>
                            <input type="number" class="form-control" id="valor" name="valor"> 
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição: </label>
                            <input type="text" class="form-control" id="descricao" name="descricao"> 
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Selecione a Data:</label>
                            <input type="date" class="form-control" id="data" name="data">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Selecione o tipo de transação: </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="radioReceita" value="receita">
                                <label class="form-check-label" for="radioReceita">Receita</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="radioDespesa" value="despesa">
                                <label class="form-check-label" for="radioDespesa">Despesa</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>
            </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($historico as $transacao) {
                            $data      = $transacao->getData();
                            $descricao = $transacao->getDescricao();
                            $tipo      = $transacao->VerificarTipo();
                            $valor     = number_format($transacao->getValor(), 2, ',', '.');
                            
                            $corLinha = ($tipo == 'Entrada') ? 'style="background-color: #76fa95;"' : 'style="background-color: #f77b86;"';
                            $corValor = ($tipo == 'Entrada') ? 'style="color: #155724; font-weight: bold;"' : 'style="color: #721c24; font-weight: bold;"';
                            
                            echo "<tr $corLinha>";
                            echo "<td>" . $data . "</td>";
                            echo "<td>" . $descricao . "</td>";
                            echo "<td>" . $tipo . "</td>";
                            echo "<td $corValor>R$ " . $valor . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>