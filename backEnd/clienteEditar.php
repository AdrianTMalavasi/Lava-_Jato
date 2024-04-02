<?php
// Incluindo o arquivo de controle para Clientes
require_once "../control/DataBaseControl.class.php";
require_once "../control/ClientesControl.class.php";

// Incluindo arquivo de configuração do site
require_once "siteConfig.php";

// Criando uma instância da classe ClienteControl, que gerencia operações relacionadas a clientes
$clienteControl = new ClienteControl($db);

// Capturando o parâmetro 'id' da URL
$id = @$_GET["id"];

// Buscando um cliente com base no ID fornecido
$cliente = $clienteControl->buscarPorId($id);

// Chamando funções para criar o cabeçalho e a seção de gerenciamento (não definida no código fornecido)
criaHeader();
criarGerenciar();

// Verificando se o cliente não foi encontrado
if ($cliente == "") {
  echo "Esse ID Não é de um Cliente";
} else if ($cliente != "") { // Verificando se o cliente foi encontrado
?>

  <!-- Início do conteúdo da página -->
  <div class="container">

    <?php
    // Capturando os parâmetros de erro e sucesso da URL
    $erro = @$_GET['error'];
    $sucesso = @$_GET['sucesso'];

    // Inicializando a variável de mensagem
    $msg = "";

    // Verificando se há mensagem de erro e exibindo, se necessário
    if ($erro != "") {
      echo $msg = '<div class="alert">
      <span class="iconify" data-icon="mdi-alert" data-inline="false"></span>
      <p><strong>Oh não!</strong> Parece que ocorreu um problema durante a edição</p>
    </div>';
    }

    // Verificando se há mensagem de sucesso e exibindo, se necessário
    if ($sucesso != "") {
      echo $msg = '<div class="sucess">
      <iconify-icon icon="el:ok-sign"></iconify-icon>
      <p><strong>Parabéns!</strong> Sua edição foi realizada com sucesso</p>
    </div>';
    }
    ?>

    <!-- Título da página com o ID do cliente -->
    <h1 class="text-center mt-5">Cliente<?php echo " ( " . $cliente->getId() . " ) " ?></h1>

    <!-- Formulário de edição de cliente -->
    <form action="EditarAcao.php?id=cliente" method="POST">
      <!-- Campo oculto para armazenar o ID do cliente -->
      <input type="hidden" name="id" value="<?php echo $cliente->getId(); ?>">

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?php echo $cliente->getNome(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" value="<?php echo $cliente->getCpf(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $cliente->getEmail(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Endereço de Cobrança</label>
        <input type="text" name="enderecoCobranca" class="form-control" value="<?php echo $cliente->getEnderecoCobranca(); ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Forma de Pagamento</label>
        <input type="text" name="formaPagamento" class="form-control" value="<?php echo $cliente->getFormaPagamento(); ?>">
      </div>

      <!-- Botões de Resetar e Confirmar -->
      <div class="row text-center p-5">
        <div class="col"><button type="reset" class="btn btn-secondary">Resetar</button>
        </div>
        <div class="col"><button type="submit" class="btn btn-success">Confirmar</button>
        </div>
      </div>
    </form>
    <!-- Fim do formulário de edição de cliente -->

  </div>
  <!-- Fim do conteúdo da página -->

<?php
}

// Chamando a função para criar o rodapé do site
criaFooter();
?>
