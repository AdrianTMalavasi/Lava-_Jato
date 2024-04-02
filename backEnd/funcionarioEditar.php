<?php
// Incluindo arquivos necessários
//require_once "../control/ClientesControl.class.php";
// require_once "./control/PessoaControl.class.php";
// include "./control/ServicosControl.class.php";
// require_once "../Classes/Funcionarios.class.php";
require_once "../control/FuncionarioControl.class.php";
require_once "../control/DataBaseControl.class.php";
require_once "siteConfig.php";

// Chamando funções de criação de header e gerenciamento
criaHeader();
criarGerenciar();

// Criando uma instância da classe FuncionarioControl e obtendo o ID da URL
$funcionarioControl = new FuncionarioControl($db);
$id = @$_GET["id"];

// Buscando o funcionário com base no ID
$funcionario = $funcionarioControl->buscarPorId($id);

// Verificando se o funcionário foi encontrado
if ($funcionario == "") {
  echo "Esse ID não pertence a um funcionário.";
} else if ($funcionario != "") {
?>

  <div class="container">
    <?php
    // Obtendo mensagens de erro/sucesso da URL e exibindo-as
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
    <h1 class="text-center mt-5">Funcionário <?php echo " ( " . $funcionario->getId() . " ) " ?></h1>

    <form action="EditarAcao.php?id=funcionario" method="POST">
      <!-- Adicionando um campo oculto para armazenar o ID do funcionário -->
      <input type="hidden" name="id" value="<?php echo $funcionario->getId(); ?>">

      <!-- Campos para editar informações do funcionário -->
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?php echo $funcionario->getNome(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" value="<?php echo $funcionario->getCpf(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $funcionario->getEmail(); ?>">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Salário</label>
        <input type="text" name="salario" class="form-control" value="<?php echo $funcionario->getSalario(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Cargo</label>
        <input type="text" name="cargo" class="form-control" value="<?php echo $funcionario->getCargo(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Data Contratação</label>
        <input type="datetime-local" name="dataContratacao" class="form-control" value="<?php echo $funcionario->getDataContratacao(); ?>">
      </div>

      <div class="row text-center p-5">
        <!-- Botões para resetar e enviar o formulário -->
        <div class="col"><button type="reset" class="btn btn-secondary">Resetar</button></div>
        <div class="col"><button type="submit" class="btn btn-success">Confirmar</button></div>
      </div>
    </form>
  </div>

<?php
}
// Chamando a função de criação de footer
criaFooter();
//print_r($funcionario);
//print_r($funcionarioControl->listar());
?>
