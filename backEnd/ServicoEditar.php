<?php
// Inclui os arquivos necessários e realiza as instâncias dos controles e serviços
require_once "../control/ClientesControl.class.php";
require_once "../control/ServicosControl.class.php";
require_once "siteConfig.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";

// Cria instâncias dos controles
$clienteControl = new ClienteControl($db);
$funcionarioControl = new FuncionarioControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Obtém o ID do serviço da superglobal $_GET
$id = @$_GET["id"];

// Busca o serviço com base no ID
$servico = $servicoControl->buscarPorId($id);

// Chama as funções para criar o cabeçalho e a seção de gerenciamento
criaHeader();
criarGerenciar();

// Verifica se o serviço foi encontrado
if ($servico == "") {
  // Se não encontrado, exibe uma mensagem indicando que o ID não é de um funcionário
  echo "Esse ID Não e de um Funcionario";
} else {
?>

  <div class="container">
    <?php
    // Verifica se há mensagens de erro ou sucesso e exibe-as
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
    <!-- Título da página -->
    <h1 class="text-center mt-5">Serviços<?php echo " ( " . $servico->getId() . " ) " ?></h1>

    <!-- Formulário para editar as informações do serviço -->
    <form action="EditarAcao.php?id=servico" method="POST">
      <!-- Campo oculto para armazenar o ID do serviço -->
      <input type="hidden" name="id" value="<?php echo $servico->getId(); ?>">

      <!-- Campos de edição para a descrição, valor, data, duração, funcionário e cliente -->
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
        <input type="text" name="descricao" class="form-control" value="<?php echo $servico->getDescricao(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Valor</label>
        <input type="text" name="valor" class="form-control" id="exampleFormControlTextarea1" value="<?php echo $servico->getValor(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Data</label>
        <input type="datetime-local" name="data" class="form-control" value="<?php echo $servico->getData(); ?>">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Duração</label>
        <input type="text" name="duracao" class="form-control" value="<?php echo $servico->getDuracao(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Funcionario:</label>
        <!-- Dropdown para selecionar o funcionário associado ao serviço -->
        <select class="form-select" name="funcionario" aria-label="Default select example" required>
          <option value="<?php echo $servico->getFuncionario()->getId();?>" selected><?php echo $servico->getFuncionario()->getNome();?></option>
          <?php
          // Preenche o dropdown com os funcionários disponíveis
          foreach ($funcionarioControl->listarObj() as $funcionario) {
            echo '<option value="' . $funcionario->getId() . '">' . $funcionario->toStringF() . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Cliente</label>
        <!-- Dropdown para selecionar o cliente associado ao serviço -->
        <select class="form-select" name="cliente" aria-label="Default select example" required>
          <option value="<?php echo $servico->getCliente()->getId(); ?>" selected><?php echo $servico->getCliente()->getNome(); ?></option>
          <?php
          // Preenche o dropdown com os clientes disponíveis
          foreach ($clienteControl->listarObj() as $clientes) {
            echo '<option value="' . $clientes->getId() . '">' . $clientes->toStringC() . '</option>';
          }
          ?>
        </select>
      </div>

      <!-- Botões de resetar e confirmar o formulário -->
      <div class="row text-center p-5">
        <div class="col"><button type="reset" class="btn btn-secondary">Resetar</SUBMIT></div>
        <div class="col"><button type="submit" class="btn btn-success">Confirmar</SUBMIT></div>
      </div>

    </form>

  </div>

<?php
}
// Chama a função para criar o rodapé
criaFooter();
?>

<?php
// Outros comentários ou códigos podem ser adicionados aqui
?>
