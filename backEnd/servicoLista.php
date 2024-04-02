<?php
// Inclui os arquivos necessários
require_once "../control/ServicosControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";

// Cria instâncias dos controles
$clienteControl = new ClienteControl($db);
$funcionarioControl = new FuncionarioControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Chama a função para criar o cabeçalho HTML
criaHeader();

// Chama a função para criar a seção de gerenciamento HTML
criarGerenciar();
?>

<div class="container">
    <?php
    // Verifica se há mensagens de erro ou sucesso para o cadastro e exibe na página
    $erro = @$_GET['error'];
    $sucesso = @$_GET['sucesso'];

    $msg = "";

    if ($erro != "") {
        echo $msg = '<div class="alert">
        <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
        <p><strong>Oh não!</strong> Parece que ocorreu um problema durante o cadastro</p>
      </div>';
    }

    if ($sucesso != "") {
        echo $msg = '<div class="sucess">
        <iconify-icon icon="el:ok-sign"></iconify-icon>
        <p><strong>Parabéns!</strong> Seu cadastro foi realizado com sucesso</p>
      </div>';
    }

    // Verifica se há mensagens de erro ou sucesso para a exclusão e exibe na página
    $msgSucesso = @$_GET['msgSucesso'];
    $msgErro = @$_GET['msgErro'];

    $msg1 = "";

    if ($msgErro != "") {
        echo $msg1 = '<div class="alert">
        <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
        <p><strong>Oh não!</strong> Parece que ocorreu um problema durante a Exclusão</p>
      </div>';
    }

    if ($msgSucesso != "") {
        echo $msg1 = '<div class="sucess">
        <iconify-icon icon="el:ok-sign"></iconify-icon>
        <p><strong>Parabéns!</strong> Serviço foi excluído com sucesso</p>
      </div>';
    }
    ?>
    <h1 class="text-center mt-5">Serviços</h1>

    <!-- Tabela para exibir os serviços -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Data</th>
                <th scope="col">Duração</th>
                <th scope="col">Funcionário</th>
                <th scope="col">Cliente</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop para exibir os serviços na tabela
            foreach ($servicoControl->listarObj() as $servico) {
                echo '<tr>
                    <th scope="row">' . $servico->getId() . '</th>
                    <td>' . $servico->getDescricao() . '</td>
                    <td>' . $servico->getValor() . '</td>
                    <td>' . $servico->getData() . '</td>
                    <td>' . $servico->getDuracao() . '</td>
                    <td>' . $servico->getFuncionario()->getNome() . '</td>
                    <td><small>' . $servico->getCliente()->getNome() . '</small></td>
                    <td>
                        <a href="servicoExcluir.php?id='. $servico->getId() . '" class="btn btn-danger">Excluir</a>
                        <a href="servicoEditar.php?id='. $servico->getId() . '" class="btn btn-primary">Editar</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Chama a função para criar o rodapé HTML
criaFooter();
?>
