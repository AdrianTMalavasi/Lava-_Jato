<?php

function criaHeader(){
    session_start();
    
    if (@$_SESSION["logado"] == 0) {
        echo '
        <!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Car Wash</title>
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/lava_jato.css">
            <link rel="icon" href="../img/logo.PNG" type="image/png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            
            <!-- Inclua o Iconify Core para lidar com os ícones -->
            <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        
        </head>
        
        <body>
            <header>
                <div class="logo flex-center-row">
                    <img src="../img/logotipo.png" alt="Logo MetaTSI" width="100" height="90" style="border-radius: 35% ; ">
                </div>
        
                <ul class="flex-center-row">
                    <li><a href="../frontEnd/home.php">Home</a></li>
                    <li><a href="../frontEnd/login.php">Login</a></li>
                </ul>
            </header>';
    }else   {
        echo '
        <!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Car Wash</title>
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/lava_jato.css">
            <link rel="icon" href="../img/logo.PNG" type="image/png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        
            <!-- Inclua o Iconify Core para lidar com os ícones -->
            <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        
        </head>
        
        <body>
            <header>
                <div class="logo flex-center-row">
                    <img src="../img/logotipo.png" alt="Logo MetaTSI" width="100" height="90" style="border-radius: 35% ; ">
                </div>
        
                <ul class="flex-center-row">
                    <li><a href="../frontEnd/home.php">Home</a></li>
                    <li><a href="../backEnd/clienteLista.php">Gerenciar</a></li>
                    <li><a href="../frontEnd/sair.php">Sair</a></li>
                </ul>
            </header>';

    }
    

}
function criaMain(){
    echo '
    <main class="flex-grow-1">

    <div class="flex-around-row ">
        <div>
            <img src="../img/breakdown-removebg-preview.png" alt="logo">
        </div>
        <div style="text-align: justify;" class="" >
            Explore a excelência automotiva em nosso site de lava jato, onde oferecemos uma gama de serviços, desde
            lavagens básicas até tratamentos premium. Nossa equipe apaixonada por detalhes se dedica a devolver o
            brilho ao seu veículo, com produtos de limpeza de alta qualidade. Além disso, nosso blog fornece dicas
            de manutenção e ofertas exclusivas, transformando sua visita em uma experiência completa. Agende online
            e confie-nos o cuidado do seu carro, priorizando sempre a beleza e a qualidade.
        </div>
    </div>
    <div class="caixa-Carousel">

        <section class="slideImg">
            <div style="background-image: url(../img/1.jpg);"></div>
            <div style="background-image: url(../img/2.jpg);"></div>
            <div style="background-image: url(../img/3.jpg);"></div>
            <div style="background-image: url(../img/4.jpg);"></div>
            <div style="background-image: url(../img/5.jpg);"></div>
            <div style="background-image: url(../img/6.jpg);"></div>
            <div style="background-image: url(../img/7.jpg);"></div>
            <div style="background-image: url(../img/8.jpg);"></div>
            <div style="background-image: url(../img/9.jpg);"></div>
        </section>
    </div>


</main>';
}
function criarGerenciar(){
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary " style="background-color: blue-800;" aria-label="Tenth navbar example">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav p-3">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Clientes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="clienteLista.php">Listar Clietes</a></li>
              <li><a class="dropdown-item" href="clienteCadastrar.php">Cadastrar Clietes</a></li>
              <li><a class="dropdown-item" href="clienteInFiltro.php">Filtrar Servicos</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav p-3">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Funcionarios</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="funcionarioLista.php">Listar Funcionario</a></li>
                <li><a class="dropdown-item" href="funcionarioCadastrar.php">Cadastrar Funcionario</a></li>
                <li><a class="dropdown-item" href="funcionarioInFiltro.php">Filtar Servicos</a></li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav" p-3>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Serviços</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="servicoLista.php">Listar Serviços</a></li>
                <li><a class="dropdown-item" href="ServicoCadastrar.php">Cadastrar Serviços</a></li>
                <li><a class="dropdown-item" href="servicoInFiltro.php">Filtar Servicos</a></li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </nav>
';
}

function criaFooter(){
    echo '    
    <footer class ="mt-auto">
    <div style="color: white;"> Seg a Sex de 08h - 18h | Sáb de 09h - 13h</div>
    <div style="color: white;"><iconify-icon icon="ic:outline-copyright"></iconify-icon>Copyright</div>
    <ul class="flex-center-column">
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
    </ul>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <img src="img/equipe.svg" alt="Meu SVG" width="100" height="100"> -->

</body>

</html>';
}

?>