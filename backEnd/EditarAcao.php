<?php
// Incluindo arquivos necessários e criando instâncias dos controles
require_once "../control/ClientesControl.class.php";
require_once "../control/ServicosControl.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Criando instâncias dos controles
$funcionarioControl = new FuncionarioControl($db);
$clienteControl = new ClienteControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Verificando se a requisição é para editar um funcionário
if (($_GET["id"]) == "funcionario") {
    // Obtendo os dados do formulário
    $id = @$_POST["id"];
    $nome = @$_POST["nome"];
    $cpf = @$_POST["cpf"];
    $email = @$_POST["email"];
    $salario = @$_POST["salario"];
    $cargo = @$_POST["cargo"];
    $dataContratacao = @$_POST["dataContratacao"];

    // Verificando se o ID está presente
    if ($id != "") {
        // Buscando o funcionário pelo ID
        $funcionario = $funcionarioControl->buscarPorId($id);

        // Atualizando as informações do funcionário
        $funcionario->setNome($nome);
        $funcionario->setCpf($cpf);
        $funcionario->setEmail($email);
        $funcionario->setSalario($salario);
        $funcionario->setCargo($cargo);
        $funcionario->setDataContratacao($dataContratacao);

        // Executando a atualização no controle e redirecionando com mensagem
        $funcionarioControl->atualizar($funcionario);
        header("Location: funcionarioLista.php?sucesso=Editado com sucesso");
    } else {
        // Redirecionando com mensagem de erro se o ID não estiver presente
        header("Location: funcionarioLista.php?erro=Não foi possível editar");
    }
}

// Verificando se a requisição é para editar um cliente
if (($_GET["id"]) == "cliente") {
    // Obtendo os dados do formulário
    $id = @$_POST["id"];
    $nome = @$_POST["nome"];
    $cpf = @$_POST["cpf"];
    $email = @$_POST["email"];
    $enderecoCobranca = @$_POST["enderecoCobranca"];
    $formaPagamento = @$_POST["formaPagamento"];

    // Verificando se o ID está presente
    if ($id != "") {
        // Buscando o cliente pelo ID
        $cliente = $clienteControl->buscarPorId($id);

        // Atualizando as informações do cliente
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setEmail($email);
        $cliente->setEnderecoCobranca($enderecoCobranca);
        $cliente->setFormaPagamento($formaPagamento);

        // Executando a atualização no controle e redirecionando com mensagem
        $clienteControl->atualizar($cliente);
        header("Location: clienteLista.php?sucesso=Editado com sucesso");
    } else {
        // Redirecionando com mensagem de erro se o ID não estiver presente
        header("Location: clienteLista.php?erro=Não foi possível editar");
    }
}

// Verificando se a requisição é para editar um serviço
if (($_GET["id"]) == "servico") {
    // Obtendo os dados do formulário
    $id = @$_POST["id"];
    $descricao = @$_POST["descricao"];
    $valor = @$_POST["valor"];
    $data = @$_POST["data"];
    $duracao = @$_POST["duracao"];
    $funcionario = @$_POST["funcionario"];
    $cliente = @$_POST["cliente"];

    // Verificando se o ID está presente
    if ($id != "") {
        // Buscando o funcionário e cliente pelo ID
        $funcionario = $funcionarioControl->buscarPorId($funcionario);
        $cliente = $clienteControl->buscarPorId($cliente);

        // Buscando o serviço pelo ID
        $servico = $servicoControl->buscarPorId($id);

        // Atualizando as informações do serviço
        $servico->setDescricao($descricao);
        $servico->setValor($valor);
        $servico->setData($data);
        $servico->setDuracao($duracao);
        $servico->setFuncionario($funcionario);
        $servico->setCliente($cliente);

        // Executando a atualização no controle e redirecionando com mensagem
        $servicoControl->atualizar($servico);
        header("Location: servicoLista.php?sucesso=Editado com sucesso");
    } else {
        // Redirecionando com mensagem de erro se o ID não estiver presente
        header("Location: servicoLista.php?erro=Não foi possível editar");
    }
}
