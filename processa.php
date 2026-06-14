<?php
require_once 'Classes/Carteira.php';
session_start();

$carteira = $_SESSION['carteira'];

try {
    if (empty($_POST['valor']) || empty($_POST['descricao']) || empty($_POST['data']) || empty($_POST['tipo'])) {
        throw new Exception('Preencha todos os campos.');
    } 
    if ($_POST['valor'] <= 0) {
        throw new Exception('O valor deve ser maior que zero.');
    }

    $valor     = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $data      = $_POST['data'];
    $tipo      = $_POST['tipo'];

    if ($tipo == 'receita') {
        $receita = new Receita($valor, $data, $descricao); 
        $carteira->adicionarReceita($receita);           
        $_SESSION['mensagem'] = 'Receita cadastrada com sucesso!';
    } 
    else if ($tipo == 'despesa') {
        $despesa = new Despesa($valor, $data, $descricao);
        $carteira->adicionarDespesa($despesa);             
        $_SESSION['mensagem'] = 'Despesa cadastrada com sucesso!';
    } else {
        throw new Exception('Tipo de transação inválido.');
    }

    } catch (Exception $e) {
        $_SESSION['mensagem'] = $e->getMessage(); 
    }

$_SESSION['carteira'] = $carteira;

header('Location: index.php');
exit;
?>