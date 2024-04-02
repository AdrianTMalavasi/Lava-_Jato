<?php
// Incluindo arquivos necessários e criando instâncias dos controles
require_once "../control/ClientesControl.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";
require_once "../control/ServicosControl.class.php";
$funcionarioControl = new FuncionarioControl($db);
$clienteControl = new ClienteControl($db);
$servicoControl = new ServicoControl($db, $funcionarioControl, $clienteControl);

// Chamando funções de criação de header e gerenciamento
criaHeader();
criarGerenciar();

?>
<div class="container">
  <?php
  // Obtendo mensagens de erro/sucesso e exibindo-as
  $erro = @$_GET['error'];
  $sucesso = @$_GET['sucesso'];
  $msg = "";

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

  // Obtendo mensagens específicas de exclusão e exibindo-as
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
    <p><strong>Parabéns!</strong> Funcionário foi excluído com sucesso</p>
  </div>';
  }

  // Obtendo dados do formulário
  $funcionario = @$_POST['funcionario'];
  $cliente = @$_POST['cliente'];
  $servicos = @$_POST['servicos'];

  // Verificando qual tipo de filtragem está sendo feita
  if (($_GET["id"]) == "funcionario") {
  ?>

    <h1 class="text-center mt-5">Funcionários Filtrados</h1>

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
        </tr>
      </thead>
      <tbody>
        <?php
        // Loop para exibir os serviços filtrados por funcionário
        foreach ($servicoControl->FiltrarServicosPorFuncionario($funcionario) as $servico) {
          echo '<tr>
                <th scope="row">' . $servico->getId() . '</th>
                <td>' . $servico->getDescricao() . '</td>
                <td>' . $servico->getValor() . '</td>
                <td>' . $servico->getData() . '</td>
                <td>' . $servico->getDuracao() . '</td>
                <td>' . $servico->getFuncionario()->getNome() . '</td>
                <td><small>' . $servico->getCliente()->getNome() . '</small></td>     
                <td>
                    <a href="servicoExcluir.php?id=' . $servico->getId() . '" class="btn btn-danger">Excluir</a>
                    <a href="servicoEditar.php?id=' . $servico->getId() . '" class="btn btn-primary">Editar</a>
                </td>
                </tr>';
        }
        ?>
      </tbody>
    </table>
    <div class="d-grid gap-2 col-6 mx-auto">
      <a class="btn btn-primary" type="reset" class="btn btn-secondary" href="funcionarioInFiltro.php">Resetar</a>
    </div>
</div>
<?php
  }
  if (($_GET["id"]) == "cliente") {
?>

  <h1 class="text-center mt-5">Clientes Filtrados</h1>

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
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop para exibir os serviços filtrados por cliente
      foreach ($servicoControl->FiltrarServicosPorClientes($cliente) as $servico) {
        echo '<tr>
              <th scope="row">' . $servico->getId() . '</th>
              <td>' . $servico->getDescricao() . '</td>
              <td>' . $servico->getValor() . '</td>
              <td>' . $servico->getData() . '</td>
              <td>' . $servico->getDuracao() . '</td>
              <td>' . $servico->getFuncionario()->getNome() . '</td>
              <td><small>' . $servico->getCliente()->getNome() . '</small></td>     
              <td>
                  <a href="servicoExcluir.php?id=' . $servico->getId() . '" class="btn btn-danger">Excluir</a>
                  <a href="servicoEditar.php?id=' . $servico->getId() . '" class="btn btn-primary">Editar</a>
              </td>
              </tr>';
      }
      ?>
    </tbody>
  </table>
  <div class="d-grid gap-2 col-6 mx-auto">
    <a class="btn btn-primary" type="reset" class="btn btn-secondary" href="clienteInFiltro.php">Resetar</a>
  </div>
  </div>

<?php
}
  if (($_GET["id"]) == "servicos") {
?>

  <h1 class="text-center mt-5">Serviços Filtrados</h1>

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
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop para exibir os serviços filtrados por serviços
      foreach ($servicoControl->FiltrarServicosPorServicos($servicos) as $servico) {
        echo '<tr>
            <th scope="row">' . $servico->getId() . '</th>
            <td>' . $servico->getDescricao() . '</td>
            <td>' . $servico->getValor() . '</td>
            <td>' . $servico->getData() . '</td>
            <td>' . $servico->getDuracao() . '</td>
            <td>' . $servico->getFuncionario()->getNome() . '</td>
            <td><small>' . $servico->getCliente()->getNome() . '</small></td>     
            <td>
                <a href="servicoExcluir.php?id=' . $servico->getId() . '" class="btn btn-danger">Excluir</a>
                <a href="servicoEditar.php?id=' . $servico->getId() . '" class="btn btn-primary">Editar</a>
            </td>
            </tr>';
      }
      ?>
    </tbody>
  </table>
  <div class="d-grid gap-2 col-6 mx-auto">
    <a class="btn btn-primary" type="reset" class="btn btn-secondary" href="servicoInFiltro.php">Resetar</a>
  </div>
  </div>
<?php
}
?>

<?php
  
  criaFooter();
?>
