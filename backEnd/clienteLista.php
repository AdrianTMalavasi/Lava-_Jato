<?php
// Incluindo arquivos necessários e criando instância do controle de clientes
require_once "../control/ClientesControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";

// Chamando funções para criar o cabeçalho e a seção de gerenciamento
criaHeader();
criarGerenciar(); 

// Criando instância do controle de clientes
$clienteControl = new ClienteControl($db);
?>

<!-- Início do conteúdo da página -->
<div class="container">
    <?php
    // Verificando mensagens de erro ou sucesso e exibindo-as, se existirem
    $erro = @$_GET['error'];
    $sucesso = @$_GET['sucesso'];

    $msg = "";

    if ($erro != "") {
        echo $msg = '<div class="alert">
        <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
        <p><strong>Oh não!</strong> Parece que ocorreu um problema durante a ação de edição</p>
        </div>';
    }

    if ($sucesso != "") {
        echo $msg = '<div class="sucess">
        <iconify-icon icon="el:ok-sign"></iconify-icon>
        <p><strong>Parabéns!</strong> Sua ação de editar foi realizada com sucesso</p>
        </div>';
    }

    // Verificando mensagens de sucesso ou erro ao excluir um cliente e exibindo-as, se existirem
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
        <p><strong>Parabéns!</strong> Cliente foi excluído com sucesso</p>
        </div>';
    }
    ?>

    <!-- Título da tabela -->
    <h1 class ="text-center mt-5">Clientes</h1>

    <!-- Tabela de clientes -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Endereço de Cobrança</th>
                <th scope="col">Forma de Pagamento</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterando sobre a lista de clientes e preenchendo a tabela
            foreach ($clienteControl->listarObj() as $cliente) {
                echo '<tr>
                    <th scope="row">'.$cliente->getId().'</th>
                    <td>'.$cliente->getNome().'</td>
                    <td>'.$cliente->getCpf().'</td>
                    <td>'.$cliente->getEmail().'</td>
                    <td>'.$cliente->getEnderecoCobranca().'</td>
                    <td><small>'.$cliente->getFormaPagamento().'</small></td>     
                    <td>
                        <a href="clienteExcluir.php?id='.$cliente->getId().'" class="btn btn-danger">Excluir</a>
                        <a href="clienteEditar.php?id='.$cliente->getId().'" class="btn btn-primary">Editar</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Fim do conteúdo da página -->

<?php
// Chamando a função para criar o rodapé
criaFooter();
?>
