<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Post.php';

?>



<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Forward - <?php echo $_SESSION['nome']?></title>
    <link rel="icon" href="../img/logo1.png">
  </head>

  <body class="bg-dark" style="background-image: url(../img/users/bg<?php echo $_SESSION['id']?>.jpg); background-size:cover; background-attachment: fixed;">
  	
  	<?php include '../modulos/nav.php' ?>

	<div class="col-2 bg-light m-0 mt-5 position-absolute ml-5" style="border-radius: 15px;">
		
		<div class="row mt-2 justify-content-center text-center">
			<h4 class="col">Edite suas informações</h4>
		</div>

		<div class="row mt-2">
			<div class="col text-center">
				<a class="navbar-brand p-0 m-0 pr-2" href="#"><img class="img rounded-circle" style="height: 150px; width: 150px; object-fit: cover;" src="../img/users/profile<?php if ($_SESSION['profile']){ echo $_SESSION['id']; } else { echo "0";}?>.jpg"></a>
			</div>	
		</div>
		<form action="../meu_perfil/editar.php" method="post">
		<div class="row mt-2 text-center">
			<div class="col">
				<p class="text-muted m-0"> <i class="fas fa-at"></i><?php echo $_SESSION['login'] ?> </p>
			</div>
		</div>

		<div class="row mt-2 text-center">
			<div class="col">
				<input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" value="<?php echo $_SESSION['nome'] ?>">
			</div>
		</div>

		<div class="row mt-2 text-center">
			<div class="col">
				<textarea class="form-control" rows="3" maxlength="140" placeholder="Bio" id="bio" name="bio"><?php echo $_SESSION['bio'] ?></textarea>
			</div>
		</div>

		<div class="row mt-3 justify-content-center">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal4">Mudar imagem de perfil</button>
		</div>

		<div class="row mt-2 justify-content-center">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal5">Mudar plano de fundo</button>
		</div>

		<div class="row mt-3 text-center">
			<div class="col">
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Insira nova senha">
			</div>
		</div>

		<div class="row mt-2 text-center">
			<div class="col">
				<input type="password" class="form-control" id="confsenha" name="confsenha" placeholder="Confirme nova senha">
			</div>
		</div>

		<div class="row mt-3 mb-2 justify-content-center">
			<button type="submit" class="btn btn-primary mr-1">Salvar</button>
			<a  href="meuperfil.php" class="btn btn-outline-danger ml-1">Cancelar</a>
			</form>
		</div>



	</div>



				<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px; opacity: 0.5">
				<div class="row">
					<h3 class="m-3 col-6">Suas Postagens:</h3>
					<h3 class="text-primary ml-auto text-right m-3 col-3"><a href="../meu_perfil/meuperfil.php"><i class="fas fa-sync-alt"></i></a></h3>
				</div>

				<?php 
				$postagens = new Post;
				$result = $postagens->getYourPosts($pdo, $_SESSION['id']);
				if($result){
					$i = 0;
					while ($i < count($result)) {
				
				?>


				<!-- post -->
			<div class="row p-0 m-0 justify-content-center mb-3">
			<div class="col p-0 m-0 bg-light border-top border-bottom" style="border-radius: 25px;">
				<div class="row mt-2" style=" vertical-align: middle;">
					<div class="col-2 text-right">
						<img class="img-fluid rounded-circle" style="height: 60px; width: 60px; object-fit: cover;" src="../img/users/profile<?php if ($_SESSION['profile']){ echo $_SESSION['id']; } else { echo "0";}?>.jpg">
					</div>
					<div class="col-6 align-middle">
						<h5 class="m-0 pt-2"><?php echo $result[$i]['nome_user']; ?></h5>
						<p class="m-0 text-muted">@<?php echo $result[$i]['login_user']; ?></p>
					</div>
					<div class="col-2">
						<p class="text-muted m-0 text-right"><?php $date = date_create($result[$i]['data']); echo date_format($date, 'd/m/Y'); ?></p>
						<p class="text-muted m-0 text-right"><?php echo date_format($date, 'H:i'); ?></p>
					</div>
				</div>
				<div class="row justify-content-center mt-4">
					<div class="col-8 jumbotron">
						<spam><?php echo $result[$i]['post']; ?></spam>
					</div> 
				</div>
				<div class="row justify-content-center">
					<div class="col-10">
						<h5 class=""><a href=""><i class="far fa-heart text-muted"></i></a> <a href=""><i class="fas fa-share-alt text-muted pl-3"></i></a><a href="removePost.php?id=<?php echo $result[$i]['id']; ?>"><i class="fas fa-times text-muted float-right"></i></a></h5>
					</div>
				</div>
			</div>
			</div>
				<!-- fim post -->

		
			<?php $i++;
		}
		}
		?>

	</div>

			<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3" aria-hidden="true">
			    <div class="modal-dialog" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title" id="exampleModalLabel">Olá, diga alguma coisa para o mundo:</h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <div class="col">
			                    <form action="postar.php" method="post">
			                        <div class="input-group">
									  <textarea class="form-control" id="post" name="post" aria-describedby="post" placeholder="Escreva aqui!" style="border-radius: 25px" rows="3" maxlength="140" required></textarea>
									</div>
			                        <div class="row justify-content-center mt-2">
			                        <button type="submit" class="btn btn-primary" style="border-radius: 25px">Postar</button>
			                        </div>
			                    </form>
			                </div>
			            </div>
			        </div>
			    </div>
			  </div>




		<!-- Modal Perfil -->
		<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Foto de Perfil</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="row justify-content-center text-center">

				<form action="../edit_img/upload.php" method="post" enctype="multipart/form-data">
				    <input type="file" name="fileToUpload" id="fileToUpload"> 
				    <input type="hidden" name="tipo" id="tipo" value="1" >
				</div>
		      </div>
		      <div class="row justify-content-center m-3">
		        <button type="submit" class="btn btn-outline-danger mr-1" formaction="../edit_img/removeProfile.php">Remover imagem</button>
		        <button type="submit" value="Upload Image" name="submit" class="btn btn-primary ml-1">Confirmar</button>
				</form>

		      </div>
		    </div>
		  </div>
		</div>



		<!-- Modal BG -->
		<div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modal5" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Imagem de Fundo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="row justify-content-center text-center">

				<form action="../edit_img/upload.php" method="post" enctype="multipart/form-data">
				    <input type="file" name="fileToUpload" id="fileToUpload"> 
				    <input type="hidden" name="tipo" id="tipo" value="2" >
				</div>
		      </div>
		      <div class="row justify-content-center m-3">
		        <button type="submit" class="btn btn-outline-danger mr-1" formaction="../edit_img/removeBG.php" >Remover fundo</button>
		        <button type="submit" value="Upload Image" name="submit" class="btn btn-primary ml-1">Confirmar</button>
				</form>

		      </div>
		    </div>
		  </div>
		</div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>