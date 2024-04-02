<?php
// Inicia a sessão
session_start();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login com um parâmetro de sucesso
header('Location: login.php?sucesso=OFF LOGIN');
?>
