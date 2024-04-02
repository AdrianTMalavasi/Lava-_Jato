<?php
// Incluindo o arquivo de configuração do site
include "../backEnd/siteConfig.php";

// Chamando a função para criar o cabeçalho da página
criaHeader();
?>

<!-- Início da seção de estilos específicos da página -->
<link rel="stylesheet" href="../css/login.css">
<!-- Fim da seção de estilos específicos da página -->

<main>
    <div class="login-container">
        <h2>Entrar</h2>
        <form action="../backEnd/site.login.php" method="POST">
            <!-- Campos de entrada para o nome de usuário e senha -->
            <input type="text" placeholder="Usuário" name="username" required>
            <input type="password" placeholder="Senha" name="password" required>

            <!-- Botão de envio do formulário -->
            <button type="submit">Entrar</button>
        </form>
    </div>
</main>;

<?php
// Chamando a função para criar o rodapé da página
criaFooter();
?>
