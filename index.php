<?php 
session_start();
require "conexao.php";
if (isset($_SESSION['id'])) {
    header('location:home/home.php');
} else{
  
?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Forward. A rede do futuro</title>
    <link rel="icon" href="img/logo1.png">
  </head>
  <body style="background-image: url(img/background.jpg); background-size:cover">

<nav class="navbar navbar-expand-lg navbar-light bg-light m-0">
  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> 
    <form class="form-inline my-2 my-lg-0" action="home/login.php" method="post">
      <input class="form-control mr-sm-2" style="border-radius: 25px" type="text" placeholder="Login" name="login" id="login">
      <input class="form-control mr-sm-2" style="border-radius: 25px" type="password" placeholder="Senha" name="senha" id="senha">
      <button class="btn btn-outline-primary my-2 my-sm-0" style="border-radius: 25px" type="submit">Entrar</button>
    </form>
  </div>
</nav>

<div class="row justify-content-center" style=" margin: 0; margin-top: 200px;">
    <div class="card col-3 col-md-5 ">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-forward fa-2x"></i></h5>
            <p class="text-muted">Forward</p>
            <h3 class="card-text">A rede social do futuro. Fique por dentro de tudo que acontece no mundo.</h3>
            <h5 class="card-text" style = "margin-top: 50px">Faça sua conta agora mesmo.</h5>
            <a href="#" class="btn btn-outline-primary mt-2 mr-2" style="border-radius: 25px" data-toggle="modal" data-target="#modal2">Inscreva-se</a>
            <a href="#" class="btn btn-primary mt-2" style="border-radius: 25px" data-toggle="modal" data-target="#modal1">Entrar</a>
        </div>
    </div>
</div>










  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bem-vindo de volta, faça seu login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <form action="home/login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="login" name="login" aria-describedby="login" placeholder="Login" style="border-radius: 25px" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required style="border-radius: 25px">
                        </div>
                        <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 25px">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>






  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bem-vindo, crie sua conta!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <form action="cadastro/cadastrar.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" placeholder="Nome" style="border-radius: 25px" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="login" name="login" aria-describedby="login" placeholder="Login" style="border-radius: 25px" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="E-mail" style="border-radius: 25px" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required style="border-radius: 25px">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confsenha" name="confsenha" placeholder="Confirmar senha" required style="border-radius: 25px">
                        </div>
                        <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 25px">Criar conta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

<?php       
    } ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>