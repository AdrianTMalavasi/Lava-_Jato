<?php
// Inclui o arquivo 'login.php', que provavelmente contém a lógica para exibir a interface de login.
require_once '../frontEnd/login.php';

// Inicia a sessão. Essa linha é necessária para usar variáveis de sessão.
session_start();

// Obtém o valor do campo de entrada de nome de usuário do formulário de login enviado por POST.
$login = @$_POST['username'];

// Obtém o valor do campo de entrada de senha do formulário de login e aplica a função md5 para criptografar a senha.
$password = md5(@$_POST['password']);

// Verifica se o nome de usuário é 'admin@admin' e se a senha criptografada é igual a '81dc9bdb52d04dc20036dbd8313ed055'.
if($login == 'admin@admin' && $password == '81dc9bdb52d04dc20036dbd8313ed055') {

    // Se as credenciais estiverem corretas, define a variável de sessão 'logado' como 1.
    $_SESSION["logado"] = 1;

    // Redireciona o usuário para 'clienteLista.php'.
    header('Location: ../backEnd/clienteLista.php');

} else {
    // Se as credenciais estiverem incorretas, define a variável de sessão 'logado' como 0.
    $_SESSION["logado"] = 0;

    // Redireciona o usuário de volta para o formulário de login com uma mensagem de erro.
    header('Location: ../frontEnd/login.php?error=LOGIN/SENHA INCORRETO');
}
?>
