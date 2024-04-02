<?php
// Inclui os arquivos necessários
require_once "../control/ClientesControl.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";
require_once "../control/ServicosControl.class.php";

// Cria instâncias dos controles
$funcionarioControl = new FuncionarioControl($db);
$clienteControl = new ClienteControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Define um vetor de serviços
$vetServicos = ["Lavagem Simples", "Lavagem Simples C/Cera", "Lavagem Chassis", "Lavagem de Motor", "Proteção de Pintura", "Lavagem de Banco", "Polimento Cristalizado", "Lavagem Teto a Seco"];

// Chama a função para criar o cabeçalho HTML
criaHeader();

// Chama a função para criar a seção de gerenciamento HTML
criarGerenciar();
?>

<div class="container ">
<?php
// Verifica se há mensagens de erro ou sucesso e exibe na página
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

<h1 class="text-center mt-5">Filtrar Serviços Pela Descrição</h1>

<form action="Filtro.php?id=servicos" method="POST">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Serviços:</label>

        <!-- Dropdown para selecionar um serviço -->
        <select class="form-select" name="servicos" aria-label="Default select example" required>
            <option selected>Selecione o Cliente</option>
            <?php
            // Loop para gerar as opções do dropdown com base no vetor de serviços
            for ($i = 0; $i < count($vetServicos); $i++) {
                echo '<option value="' . $vetServicos[$i] . '">' . $vetServicos[$i] . '</option>';
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
// Chama a função para criar o rodapé HTML
criaFooter();
?>
