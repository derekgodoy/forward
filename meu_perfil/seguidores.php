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
		  <a href='../meu_perfil/seguidores.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action active">
		    Seguidores
		    <span class="badge badge-danger badge-pill"><?php echo count($seguidores); if ($solic){echo "*";} ?></span>
		  </a>
		  <a href='../meu_perfil/minhasfotos.php' style="font-size: 13px;" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
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


	</div>




	<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px;">
				<div class="row text-center">
					<h3 class="m-3 col pb-2"   ><i><a href="../meu_perfil/seguindo.php" style="font-size: 18px !important;" class=" text-muted">Seguindo: <?php echo count($seguindo) ?></i></h3></a>
					<h3 class="m-3 col border-bottom pb-2"><b style="font-size: 18px !important;">Seguidores: <?php echo count($seguidores); if($solic){echo "*";}?></b></h3>
					</div>


				<?php if ($solic) { ?>

				<a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><div class="alert alert-primary text-center" role="alert">
				  Você tem <?php echo count($solic) ?> novas solicitações de amizade!
				</div></a>

				<div class="collapse" id="collapseExample">
				  <div class="card card-body text-center">
				    	<div class="row">
				    <?php foreach ($solic as $sol) { 

				    $info = $segue->getLogin($pdo, $sol['id_segue']);
						if ($info) {
					        $login = $info[0];
					        $nome = $info[2];
					        $profile = $info[3]; 
				        	$bio = $info[4];  
					    }

				    	?>
				    
				    <div class="col p-1 m-1" style="border-radius: 10px;">
				    <a href="../amigos/perfil.php?id=<?php echo $sol['id_segue'];?>"><img src="../img/users/profile<?php if($profile){echo $sol['id_segue'];}else{echo "0";} ?>.jpg" height="70px" width=70px" class="rounded-circle mb-1" style="object-fit: cover"></a>
				    <h5><?php echo $nome ?></h5>
				    <p>@<?php echo $login ?></p>
				    <p class="text-muted"><?php echo $bio ?></p>
				    <div class="row m-1">
					    <div class="col">
					    	<form action="../amigos/autoriza.php" method="post">
					    	<input type="hidden" name="id_segue" value="<?php echo $sol['id_segue']; ?>">
					    	<button type="submit" class="btn btn-sm btn-outline-success float-right">Aceitar</i></button>
					    </div>
					    <div class="col">
					    	<button type="submit" formaction="../amigos/removeramigo.php" class="btn btn-sm btn-outline-danger float-left">Rejeitar</i></button>
					    	</form>
					    </div>
				    </div>
					</div>
					<?php } ?>

				  </div>
				  </div>
				</div>


				<?php } ?>




				<div class="row justify-content-center">

				<?php
				if($seguidores){

				foreach ($seguidores as $r) {

				$info = $segue->getLogin($pdo, $r['id_segue']);
					if ($info) {
				        $login = $info[0];
				        $nome = $info[2];
				        $profile = $info[3]; 
			        	$bio = $info[4];  
				    }

				?>
				<!-- resultado -->

					<div class="card text-center m-2" style="width: 14rem; border-radius: 20px;">
					  <div class="row justify-content-center mt-2"> <a href="../amigos/perfil.php?id=<?php echo $r['id_segue']; ?>" style="text-decoration: none;">
					  <img class="card-img-top img-fluid rounded-circle" style="height: 100px; width: 100px; object-fit: cover;" src="../img/users/profile<?php if ($profile){ echo $r['id_segue']; } else { echo "0";}?>.jpg">
					  </div>
					  <div class="card-body">
						<p><b><?php echo $nome?></b></p> </a>
						<p><b><i class="fas fa-at"></i><?php echo $login?></b></p>
						<p class="text-muted"><?php if($bio){echo "<i class='fas fa-xs fa-quote-left'></i> ".$bio." <i class='fas fa-xs fa-quote-right'></i>";}else{echo "  ";}?></p>
						<form action="../amigos/adicionar.php" method="post">
							<input type="hidden" name="id_seguido" id="id_seguido" value="<?php echo $r['id_segue'] ?>">
							
							<?php
							$arr = [];
							foreach ($seguindo as $am) {
								array_push($arr, $am['id_seguido']);
							}

							if (in_array($r['id_segue'], $arr)) {

							?>

							<button formaction="../amigos/removeramigo.php" class="btn btn-outline-danger" style="border-radius: 15px;">Deixar de seguir</button>

						<?php }  else{ ?>


							<button type="sumbit" class="btn btn-outline-primary" style="border-radius: 15px;">Seguir de volta</button>

						<?php } ?>
						


						</form>
				      </div>
					</div>
					
				<!-- fim resultado -->

		
			<?php }?>
				</div>
		<?php } else { ?>
				<div class="jumbotron m-3 text-center w-100">
				<h3>Você ainda não tem seguidores.</h3>
				</div>
			</div>
		<?php } ?>





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









    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>