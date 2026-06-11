<?php
session_start();
require_once 'Classes\Carteira.php';

if (!isset($_SESSION['carteira'])) {
    $_SESSION['carteira'] = new Carteira();
}

$carteira = $_SESSION['carteira'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPocket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

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
</body>
</html>