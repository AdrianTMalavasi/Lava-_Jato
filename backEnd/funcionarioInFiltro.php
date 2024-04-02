<?php
// Incluindo arquivos necessários
include "siteConfig.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Criando instâncias das classes FuncionarioControl e DataBaseControl
$funcionarioControl = new FuncionarioControl($db);

// Chamando funções para criar o cabeçalho e a seção de gerenciamento
criaHeader();
criarGerenciar();
?>

<!-- Início do conteúdo da página -->
<div class="container">
    <?php
    // Verificando se há mensagens de erro ou sucesso
    $erro = @$_GET['error'];
    $sucesso = @$_GET['sucesso'];

    // Inicializando variável para mensagem
    $msg = "";

    // Exibindo mensagem de erro, se houver
    if ($erro != "") {
        echo $msg = '<div class="alert">
            <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
            <p><strong>Oh não!</strong> Parece que ocorreu um problema durante o cadastro</p>
        </div>';
    }

    // Exibindo mensagem de sucesso, se houver
    if ($sucesso != "") {
        echo $msg = '<div class="sucess">
            <iconify-icon icon="el:ok-sign"></iconify-icon>
            <p><strong>Parabéns!</strong> Seu cadastro foi realizado com sucesso</p>
        </div>';
    }
    ?>
    
    <!-- Título do formulário -->
    <h1 class="text-center mt-5">Filtrar Serviços do Funcionário</h1>

    <!-- Formulário para filtrar serviços por funcionário -->
    <form action="Filtro.php?id=funcionario" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Funcionário:</label>

            <!-- Dropdown para selecionar um funcionário -->
            <select class="form-select" name="funcionario" aria-label="Default select example" required>
                <option selected>Selecione o Funcionário</option>

                <!-- Iterando sobre a lista de funcionários e criando opções no dropdown -->
                <?php
                foreach ($funcionarioControl->listarObj() as $funcionario) {
                    echo '<option value="' . $funcionario->getId() . '">' . $funcionario->toStringF() . '</option>';
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

<?php
// Chamando função para criar o rodapé da página
criaFooter();
?>
