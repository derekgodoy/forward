<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Midia.php';
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
  			
<?php 	include '../modulos/nav.php';
				$postagens = new Post;
				$galeria = new Midia;
				$segue = new Usuario;
				$post = $postagens->getYourPosts($pdo, $_SESSION['id']);
				$fotos = $galeria->getGaleria($pdo, $_SESSION['id']);
				$seguindo = $segue->getSeguindo($pdo, $_SESSION['id']);
				$seguidores = $segue->getSeguidores($pdo, $_SESSION['id']);
				$solic = $segue->getSolicitacoes($pdo, $_SESSION['id']);
				 ?>

	<div class="col-2 bg-light mt-5 position-fixed ml-5" style="border-radius: 15px;">
			
		<div class="row mt-2">
			<div class="col text-center">
				<a class="p-0 m-0 pr-2" href="meuperfil.php"><img class="img rounded-circle" style="height: 150px; width: 150px; object-fit: cover;" src="../img/users/profile<?php if ($_SESSION['profile']){ echo $_SESSION['id']; } else { echo "0";}?>.jpg"></a>
			</div>	
		</div>

		<div class="row mt-2 text-center">
			<div class="col">
				<h4> <?php echo $_SESSION['nome'] ?> </h4>
			</div>
		</div>

		<div class="row text-center">
			<div class="col">
				<p class="text-muted"> <i class="fas fa-at"></i><?php echo $_SESSION['login'] ?> </p>
			</div>
		</div>

		<div class="row text-center">
			<div class="col">
				<p class="text-muted"><?php echo $_SESSION['bio'] ?> </p>
			</div>
		</div>

		<div class="mb-2">
		<ul class="list-group">
		  <a href='../meu_perfil/meuperfil.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
		    Posts
		    <span class="badge badge-danger badge-pill"><?php echo count($post) ?></span>
		  </a>
		  <a href='../meu_perfil/seguindo.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
		    Seguindo
		    <span class="badge badge-danger badge-pill"><?php echo count($seguindo) ?></span>
		  </a>
		  <a href='../meu_perfil/seguidores.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
		    Seguidores
		    <span class="badge badge-danger badge-pill"><?php echo count($seguidores); if ($solic){echo "*";} ?></span>
		  </a>
		  <a href='../meu_perfil/minhasfotos.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action active">
		    Fotos
		    <span class="badge badge-danger badge-pill"><?php echo count($fotos) ?></span>
		  </a>
		  <a href='#' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
		    Vídeos
		    <span class="badge badge-danger badge-pill">1</span>
		  </a>
		</ul>
		</div>


	</div>






<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px;">
				<div class="row">
					<h3 class="m-3 col-6">Suas Fotos:</h3>
					<h3 class="text-primary ml-auto text-right m-3 col-3"><a href="#" data-toggle="modal" data-target="#modalimg"><i class="fas fa-file-image fa-2x"></i></a></h3>
				</div>



			<div class="row justify-content-center mt-2">
				<?php 
					if ($fotos) {
						$i = 0;
						while ($i < count($fotos)) {
				?>

				<div class="col mb-3 text-center">
						<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $fotos[$i]['legenda']?>" data-image="../img/users/galeria/<?php echo $fotos[$i]['nome']?>.jpg" data-target="#image-gallery">
					<figure class="figure ">
						<img src="../img/users/galeria/<?php echo $fotos[$i]['nome']?>.jpg" style="width: 280px; height: 280px; object-fit: cover; border-radius: 10px;">
					</figure>
						</a>
						<form action="../edit_img/removerGaleria.php" method="post">
							<input type="hidden" name="nome" value="<?php echo $fotos[$i]['nome']?>">
							<button type="submit" class="btn btn-outline-danger btn-sm">X</button>
						</form>
				</div>


					<?php
					$i++;
					}
					} else {
					?>


					<div class="jumbotron m-3 text-center ">
				<h3>Você ainda não postou nenhuma foto. Envie uma abaixo:</h3>
				<div class="row justify-content-center">
					<div class="col-8 mt-5">	                        
		      	<div class="row justify-content-center text-center">
</div>
						<form action="../edit_img/upload.php" method="post" enctype="multipart/form-data">
				    <input type="file" name="fileToUpload" id="fileToUpload"> 
				    <textarea class="form-control mt-4" id="legenda" name="legenda" aria-describedby="legenda" placeholder="Insira uma legenda" style="border-radius: 25px" rows="3" maxlength="140"></textarea>
				    <input type="hidden" name="tipo" id="tipo" value="3" >
				
	                        <div class="row justify-content-center mt-3">
	                        <button type="submit" class="btn btn-primary" style="border-radius: 25px">Enviar</button>
	                        </div>
	                    </form>
	                </div>
				</div>
			</div>

		<?php } ?>
			</div>



		
			
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
			                    <form action="../home/postar.php" method="post">
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


 <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">

                        <div class=" mt-3 row justify-content-center" >
	                    <div class="col">
	                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
	                        </button>
                        </div>
                        <div class="col text-center">
                        	<h5 class="modal-title" id="image-gallery-title"></h5>
                        </div> 
	                    <div class="col ">
	                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
	                        </button>
                    	</div>
                    </div>
                    </div>
                    <div class="m-3">
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>


   <div class="modal fade" id="modalimg" tabindex="-1" role="dialog" aria-labelledby="modal4" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Escolha uma foto:</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="row justify-content-center text-center">

				<form action="upload.php" method="post" enctype="multipart/form-data">
				    <input type="file" name="fileToUpload" id="fileToUpload"> 
				    <textarea class="form-control mt-3" id="legenda" name="legenda" aria-describedby="legenda" placeholder="Insira uma legenda" style="border-radius: 25px" rows="3" maxlength="140"></textarea>
				    <input type="hidden" name="tipo" id="tipo" value="3" >
				</div>
		      </div>
		      <div class="row justify-content-center m-3">
		        <button type="submit" value="Upload Image" name="submit" class="btn btn-primary ml-1">Enviar</button>
				</form>

		      </div>
		    </div>
		  </div>
		</div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="../js/gallery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>