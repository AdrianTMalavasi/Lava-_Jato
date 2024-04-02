<?php
// Incluindo a configuração do site
require_once "siteConfig.php";

// Chamando a função para criar o cabeçalho do site
criaHeader();

// Chamando a função para criar a seção de gerenciamento (não definida no código fornecido)
criarGerenciar();
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
        <p ><strong>Oh não!</strong> Parece que ocorreu um problema durante o cadastro</p>
      </div>';
  }

  // Verificando se há mensagem de sucesso e exibindo, se necessário
  if ($sucesso != "") {
      echo $msg = '<div class="sucess">
        <iconify-icon icon="el:ok-sign"></iconify-icon>
        <p><strong>Parabéns!</strong> Seu cadastro foi realizado com sucesso</p>
      </div>';
  }
  ?>

  <!-- Título da página -->
  <h1 class="text-center mt-5">Cadastrar Cliente</h1>

  <!-- Formulário de cadastro de cliente -->
  <form action="CadastrarAcao.php?id=cliente" method="POST">

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" placeholder="Insira um Nome" required>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">CPF</label>
      <input type="text" name="cpf" class="form-control" oninput="formatarCPF(this)" maxlength="14" placeholder="Insira seu CPF" id="cpfInput" required>
      <script>
        // Função para formatar o CPF
        function formatarCPF(input) {
          // Remove caracteres não numéricos
          let cpfSemFormatacao = input.value.replace(/\D/g, '');

          // Adiciona pontos e traço na posição correta
          cpfSemFormatacao = cpfSemFormatacao.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');

          // Atualiza o valor no input
          input.value = cpfSemFormatacao;
        }
      </script>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email</label>
      <input type="text" name="email" class="form-control" placeholder="Insira seu Email" required>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Endereço de Cobrança</label>
      <input type="text" name="enderecoCobranca" class="form-control" placeholder="Insira seu Endereço de Cobrança" required>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Forma de Pagamento</label>
      <input type="text" name="formaPagamento" class="form-control" placeholder="Insira a Forma de Pagamento" required>
    </div>

    <!-- Botões de Resetar e Cadastrar -->
    <div class="row text-center p-5">
      <div class="col">
        <button type="reset" class="btn btn-secondary">Resetar</button>
      </div>
      <div class="col">
        <button type="submit" class="btn btn-success">Cadastrar</button>
      </div>
    </div>

  </form>
  <!-- Fim do formulário de cadastro de cliente -->

</div>
<!-- Fim do conteúdo da página -->

<?php
// Chamando a função para criar o rodapé do site
criaFooter();
?>
