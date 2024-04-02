<?php
// Inclui os arquivos necessários
require_once "../Classes/Funcionarios.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";

// Cria uma instância do controle de funcionários
$funcionarioControl = new FuncionarioControl($db);

// Inicia a construção do cabeçalho e navegação
criaHeader();
criarGerenciar();
?>

<!-- Início do conteúdo da página -->
<div class="container">
    <?php
    // Verifica se há mensagens de erro ou sucesso e exibe alertas correspondentes
    $erro = @$_GET['error'];
    $sucesso = @$_GET['sucesso'];

    $msg = ""; // Variável para armazenar mensagens

    if ($erro != "") {
        echo $msg = '<div class="alert">
            <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
            <p><strong>Oh não!</strong> Parece que ocorreu um problema durante a edição</p>
        </div>';
    }

    if ($sucesso != "") {
        echo $msg = '<div class="sucess">
            <iconify-icon icon="el:ok-sign"></iconify-icon>
            <p><strong>Parabéns!</strong> Sua ação de editar foi realizado com sucesso</p>
        </div>';
    }

    $msgSucesso = @$_GET['msgSucesso'];
    $msgErro = @$_GET['msgErro'];

    $msg1 = ""; // Variável para armazenar mensagens de exclusão

    if ($msgErro != "") {
        echo $msg1 = '<div class="alert">
            <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
            <p><strong>Oh não!</strong> Parece que ocorreu um problema durante o Excluir</p>
        </div>';
    }

    if ($msgSucesso != "") {
        echo $msg1 = '<div class="sucess">
            <iconify-icon icon="el:ok-sign"></iconify-icon>
            <p><strong>Parabéns!</strong> Funcionario foi excluido com sucesso</p>
        </div>';
    }
    ?>
    
    <!-- Título da página -->
    <h1 class="text-center mt-5">Funcionarios</h1>

    <!-- Tabela para listar os funcionários -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Salario</th>
                <th scope="col">Cargo</th>
                <th scope="col">Data de Contratação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop para exibir cada funcionário na tabela
            foreach ($funcionarioControl->listarObj() as $funcionario) {
                echo '<tr>
                    <th scope="row">' . $funcionario->getId() . '</th>
                    <td>' . $funcionario->getNome() . '</td>
                    <td>' . $funcionario->getCpf() . '</td>
                    <td>' . $funcionario->getEmail() . '</td>
                    <td>' . $funcionario->getSalario() . '</td>
                    <td>' . $funcionario->getCargo() . '</td>
                    <td><small>' . $funcionario->getDataContratacao() . '</small></td>     
                    <td>
                        <a href="funcionarioExcluir.php?id=' . $funcionario->getId() . '" class="btn btn-danger">Excluir</a>
                        <a href="funcionarioEditar.php?id=' . $funcionario->getId() . '" class="btn btn-primary">Editar</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Finaliza a página com o rodapé
criaFooter();
?>
