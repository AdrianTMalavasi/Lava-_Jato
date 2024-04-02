<?php
// Incluindo o arquivo de configuração do site
include "../backEnd/siteConfig.php";

// Chamando função para criar o cabeçalho da página
criaHeader();

// Chamando função para criar a seção de gerenciamento (se existir)
criarGerenciar();

// Chamando função para criar o rodapé da página
criaFooter();
?>
