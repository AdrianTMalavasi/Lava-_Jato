<?php
// Inclui os arquivos necessários
require_once "../control/ClientesControl.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";

// Cria instâncias dos controles
$clienteControl = new ClienteControl($db);
$funcionarioControl = new FuncionarioControl($db);
$vetServicos = ["Lavagem Simples", "Lavagem Simples C/Cera", "Lavagem Chassis", "Lavagem de Motor", "Proteção de Pintura", "Lavagem de Banco", "Polimento Cristalizado", "Lavagem Teto a Seco"];

// Chama as funções para criar o cabeçalho e a seção de gerenciamento
criaHeader();
criarGerenciar();
?>

<div class="container">
  <?php
  // Verifica se há mensagens de erro ou sucesso
  $erro = @$_GET['error'];
  $sucesso = @$_GET['sucesso'];

  $msg = "";

  // Exibe mensagens de erro
  if ($erro != "") {
    echo $msg = '<div class="alert">
    <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
    <p><strong>Oh não!</strong> Parece que ocorreu um problema durante o cadastro</p>
  </div>';
  }

  // Exibe mensagens de sucesso
  if ($sucesso != "") {
    echo $msg = '<div class="sucess">
    <iconify-icon icon="el:ok-sign"></iconify-icon>
    <p><strong>Parabéns!</strong> Seu cadastro foi realizado com sucesso</p>
  </div>';
  }
  ?>

  <h1 class="text-center mt-5">Cadastrar Serviço</h1>

  <!-- Formulário de cadastro de serviço -->
  <form action="CadastrarAcao.php?id=servico" method="POST">
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
      <select class="form-select" name="descricao" aria-label="Default select example" id="descricao" required>
        <option disabled required>Selecione o Serviço</option>
        <?php
        // Preenche o dropdown com as opções de serviços
        for ($i = 0; $i < count($vetServicos); $i++) {
          echo '<option value="' . $vetServicos[$i] . '">' . $vetServicos[$i] . '</option>';
      }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Valor:</label>
      <input type="text" name="valor" class="form-control" placeholder="Insira um Valor" required>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Data:</label>
      <input type="datetime-local" name="data" class="form-control" >
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Duração:</label>
      <input type="text" name="duracao" class="form-control" placeholder="Insira uma Duração" required>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Funcionário:</label>
      <select class="form-select" name="funcionario" aria-label="Default select example" required>
        <option selected>Selecione o Funcionário</option>
        <?php
        // Preenche o dropdown com os funcionários
        foreach ($funcionarioControl->listarObj() as $funcionario) {
          echo '<option value="' . $funcionario->getId() . '">' . $funcionario->toStringF() . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Cliente:</label>
      <select class="form-select" name="cliente" aria-label="Default select example" required>
        <option selected>Selecione o Cliente</option>
        <?php
        // Preenche o dropdown com os clientes
        foreach ($clienteControl->listarObj() as $cliente) {
          echo '<option value="' . $cliente->getId() . '">' . $cliente->toStringC() . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="row text-center p-5">
      <div class="col"><button type="reset" class="btn btn-secondary">Resetar</button></div>
      <div class="col"><button type="submit" class="btn btn-success">Cadastrar</button></div>
    </div>
  </form>
</div>

<?php
// Chama a função para criar o rodapé
criaFooter();
?>
