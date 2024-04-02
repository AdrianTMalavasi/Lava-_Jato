<?php
// Incluindo arquivos necessários
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Criando uma instância da classe FuncionarioControl
$funcionarioControl = new FuncionarioControl($db);

// Obtendo o ID do funcionário da URL
$id = @$_GET["id"];

// Verificando se o ID não está vazio
if ($id != "") {
    // Buscando o funcionário com base no ID
    $funcionario = $funcionarioControl->buscarPorId($id);

    // Verificando se o funcionário foi encontrado
    if ($funcionario) {
        // Tentando deletar o funcionário
        if ($funcionarioControl->deletar($funcionario)) {
            // Redirecionando com uma mensagem de sucesso em caso de êxito
            header("Location: funcionarioLista.php?msgSucesso=DELEÇÃO REALIZADA COM SUCESSO");
        } else {
            // Redirecionando com uma mensagem de erro em caso de falha na deleção
            header("Location: funcionarioLista.php?msgErro=ERRO NA DELEÇÃO");
        }
    } else {
        // Redirecionando com uma mensagem em caso de ID não encontrado
        header("Location: funcionarioLista.php?msg=ID não encontrado");
    }
} else {
    // Redirecionando em caso de ID vazio
    header("Location: funcionarioLista.php?msg=ID não fornecido");
}
?>
