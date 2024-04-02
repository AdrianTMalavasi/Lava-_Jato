<?php
// Inclui os arquivos necessários e realiza as instâncias dos controles e serviços
require_once "../control/ServicosControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Cria instâncias dos controles
$clienteControl = new ClienteControl($db);
$funcionarioControl = new FuncionarioControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Obtém o ID do serviço da superglobal $_GET
$id = @$_GET["id"];

// Verifica se o ID foi informado
if ($id != "") {
    // Busca o serviço com base no ID
    $servico = $servicoControl->buscarPorId($id);

    // Verifica se o serviço foi encontrado
    if ($servicoControl->deletar($servico)) {
        // Se a exclusão for bem-sucedida, redireciona para a página de lista de serviços com mensagem de sucesso
        header("Location: servicoLista.php?msgSucesso=DELEÇÃO REALIZADA COM SUCESSO");
    } else {
        // Se ocorrer um erro durante a exclusão, redireciona para a página de lista de serviços com mensagem de erro
        header("Location: servicoLista.php?msgErro=ERRO NA DELEÇÃO");
    }
} else {
    // Se o ID não foi encontrado, redireciona para a página de lista de serviços com mensagem indicando que o ID não foi encontrado
    header("Location: servicoLista.php?msg=ID não encontrado");
}
?>
