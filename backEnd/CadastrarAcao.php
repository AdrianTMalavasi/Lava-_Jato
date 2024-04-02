
<?php
// Inclusão de arquivos necessários
require_once  "../Classes/Database.class.php";
require_once "../control/ServicosControl.class.php";
require_once "../Classes/Servicos.class.php";
require_once "../control/DataBaseControl.class.php";

// Instanciação de controladores
$funcionarioControl = new FuncionarioControl($db);
$clienteControl = new ClienteControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Verificação do tipo de operação com base no parâmetro GET "id"
if (($_GET["id"]) == "servico") {
    // Criação de um objeto Servico com dados do POST
    $servico = new Servico(
        @$_POST["descricao"],
        @$_POST["valor"],
        @$_POST["data"],
        @$_POST["duracao"],
        $funcionarioControl->buscarPorId(@$_POST["funcionario"]),
        $clienteControl->buscarPorId(@$_POST["cliente"])
    );
    // Cadastro do serviço e redirecionamento com mensagem de sucesso
    $servicoControl->cadastrar($servico);
    header("Location: ServicoCadastrar.php?sucesso=Cadastrado com sucesso");
}

if (($_GET["id"]) == "cliente") {
    // Criação de um objeto Cliente com dados do POST
    $cliente = new Cliente(
        @$_POST["nome"],
        @$_POST["cpf"],
        @$_POST["email"],
        @$_POST["enderecoCobranca"],
        @$_POST["formaPagamento"]
    );
    // Cadastro do cliente e redirecionamento com mensagem de sucesso
    $clienteControl->cadastrar($cliente);
    header("Location: clienteCadastrar.php?sucesso=Cadastrado com sucesso");
}

if (($_GET["id"]) == "funcionario") {
    // Criação de um objeto Funcionario com dados do POST
    $funcionario = new Funcionario(
        @$_POST["nome"],
        @$_POST["cpf"],
        @$_POST["email"],
        @$_POST["salario"],
        @$_POST["cargo"],
        @$_POST["dataContratacao"]
    );
    // Cadastro do funcionário e redirecionamento com mensagem de sucesso
    $funcionarioControl->cadastrar($funcionario);
    header("Location: funcionarioCadastrar.php?sucesso=Cadastrado com sucesso");
}
?>
