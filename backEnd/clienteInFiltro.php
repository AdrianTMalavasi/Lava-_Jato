<?php
// Incluindo o arquivo de configuração do site e as classes necessárias
include "siteConfig.php";
require_once "../control/ClientesControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Criando uma instância do controle de clientes
$clienteControl = new ClienteControl($db);

// Chamando funções para criar o cabeçalho e a seção de gerenciamento
criaHeader();
criarGerenciar();
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
            <p><strong>Oh não!</strong> Parece que ocorreu um problema durante o cadastro</p>
        </div>';
    }

    if ($sucesso != "") {
        echo $msg = '<div class="sucess">
            <iconify-icon icon="el:ok-sign"></iconify-icon>
            <p><strong>Parabéns!</strong> Seu cadastro foi realizado com sucesso</p>
        </div>';
    }
    ?>

    <!-- Formulário para filtrar serviços do cliente -->
    <h1 class="text-center mt-5">Filtrar Serviços do Cliente</h1>

    <form action="Filtro.php?id=cliente" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Cliente</label>

            <!-- Dropdown para selecionar o cliente -->
            <select class="form-select" name="cliente" aria-label="Default select example" required>
                <option selected>Selecione o Cliente</option>
                <?php
                // Iterando sobre a lista de clientes e criando opções no dropdown
                foreach ($clienteControl->listarObj() as $clientes) {
                    echo '<option value="' . $clientes->getId() . '">' . $clientes->toStringC() . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Botões para resetar e confirmar o formulário -->
        <div class="row text-center p-5">
            <div class="col"><button type="reset" class="btn btn-secondary">Resetar</button></div>
            <div class="col"><button type="submit" class="btn btn-success">CONFIRMAR</button></div>
        </div>
    </form>
</div>
<!-- Fim do conteúdo da página -->

<?php
// Chamando a função para criar o rodapé
criaFooter();
?>
