<?php
// Incluindo o arquivo de configuração do site
include "siteConfig.php";

// Chamando funções de criação de header e gerenciamento
criaHeader();
criarGerenciar();
?>

<div class="container ">
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

  <h1 class="text-center mt-5">Cadastrar Funcionário</h1>

  <form action="CadastrarAcao.php?id=funcionario" method="POST">

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" placeholder="Insira um Nome">
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">CPF</label>
      <input type="text" name="cpf" class="form-control" oninput="formatarCPF(this)" maxlength="14" placeholder="Insira seu CPF" id="cpfInput">
      <script>
        // Função para formatar o CPF enquanto o usuário digita
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
      <input type="text" name="email" class="form-control" placeholder="Insira seu Email">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Salário</label>
      <input type="text" name="salario" class="form-control" placeholder="Insira seu Salário">
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Cargo</label>
      <input type="text" name="cargo" class="form-control" placeholder="Insira seu Cargo">
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Data de Contratação</label>
      <input type="date" name="dataContratacao" class="form-control" placeholder="Insira sua data de contratação">
    </div>
    <div class="row text-center p-5">
      <!-- Botões para resetar e enviar o formulário -->
      <div class="col"><button type="reset" class="btn btn-secondary">Resetar</button></div>
      <div class="col"><button type="submit" class="btn btn-success">Cadastrar</button></div>
    </div>

  </form>
</div>

<?php
// Chamando a função de criação de footer
criaFooter();
?>
