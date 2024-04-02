<?php
// Incluindo a classe de controle de clientes e a classe de controle de banco de dados
require_once "../control/ClientesControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Criando uma instância do controle de clientes
$clienteControl = new ClienteControl($db);

// Obtendo o ID do cliente da consulta GET
$id = @$_GET["id"];

// Verificando se o ID não está vazio
if ($id != "") {
    // Buscando o cliente com base no ID
    $cliente = $clienteControl->buscarPorId($id);

    // Verificando se o cliente foi encontrado
    if ($clienteControl->deletar($cliente)) {
        // Redirecionando para a página de lista de clientes com uma mensagem de sucesso
        header("Location: clienteLista.php?msgSucesso=DELEÇÃO REALIZADA COM SUCESSO");
    } else {
        // Redirecionando para a página de lista de clientes com uma mensagem de erro
        header("Location: clienteLista.php?msgErro=ERRO NA DELEÇÃO");
    }
} else {
    // Redirecionando para a página de lista de clientes com uma mensagem indicando que o ID não foi encontrado
    header("Location: clienteLista.php?msgId=ID não encontrado");
}
?>
