<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Post.php';
require '../Classes/Midia.php';

$id = $_GET['id'];

	if ($id == $_SESSION['id']) {
		header('location:../meu_perfil/meuperfil.php');
	} else {

$usuario = new Usuario;
	$result = $usuario->getLogin($pdo, $id);
	 if ($result) {
	        $login = $result[0];
	        $email = $result[1];
	        $nome = $result[2];
	        $profile = $result[3]; 
        	$bio = $result[4];  
	    }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Forward - <?php echo $nome?></title>
    <link rel="icon" href="../img/logo1.png">
  </head>

  <body class="bg-dark" style="background-image: url(../img/users/bg<?php echo $id?>.jpg); background-size:cover; background-attachment: fixed;">
  

	<?php include '../modulos/nav.php';

		$postagens = new Post;
		$segue = new Usuario;
		$galeria = new Midia;
		$result = $postagens->getYourPosts($pdo, $id);
		$amigos = $segue->getSeguindo($pdo, $_SESSION['id']);
		$res = $galeria->getGaleria($pdo, $id);
		$seguidores = $segue->getSeguidores($pdo, $id);
		$seguindo = $segue->getSeguindo($pdo, $id);
	?>

	<div class="col-2 bg-light mt-5 position-fixed ml-5" style="border-radius: 15px;">
			
		<div class="row mt-2">
			<div class="col text-center">
				<a class="p-0 m-0 pr-2" href="#"><img class="img rounded-circle" style="height: 150px; width: 150px; object-fit: cover;" src="../img/users/profile<?php if ($profile){ echo $id; } else { echo "0";}?>.jpg"></a>
			</div>	
		</div>
		<div class="row mt-2 text-center">
			<div class="col">
				<h4> <?php echo $nome; ?> </h4>
			</div>
		</div>
		<div class="row mt-2 text-center">
			<div class="col">
				<p class="text-muted"> <i class="fas fa-at"></i><?php echo $login ?> </p>
			</div>
		</div>
		<div class="row  text-center">
			<div class="col">
				<p class="text-muted"><?php echo $bio ?> </p>
			</div>
		</div>

		<div class="row mt-2 mb-3 text-center">
			<div class="col">
				<form action="../amigos/adicionar.php" method="post">
				<input type="hidden" name="id_seguido" id="id_seguido" value="<?php echo $id ?>">

				<?php 

				
				if($amigos){
				$arr = [];
				foreach ($amigos as $am) {
					array_push($arr, $am['id_seguido']);
				}

				if (in_array($id, $arr)) {

				?>

				<button formaction="../amigos/removeramigo.php" class="btn btn-outline-danger" style="border-radius: 15px;">Deixar de seguir</button>

			<?php } else { ?>


				<button type="sumbit" class="btn btn-outline-primary" style="border-radius: 15px;">+ Seguir</button>

			<?php }
			}
			 ?>
				</form>
			</div>
		</div>


		<div class="text-center mt-2 mb-2">
		
				<p class="font-weight-bold text-primary m-0">Posts: <?php echo count($result) ?></p>
			
				<div class="row mt-3">
				<div class="col">
					<p class="font-weight-bold text-primary m-0" >Seguidores: <?php echo count($seguidores) ?></p>
				</div>
				<div class="col">
					<p class="font-weight-bold text-primary m-0" >Seguindo: <?php echo count($seguindo) ?></p>
				</div>
				</div>
			

				<div class="row mt-3">
				<div class="col">
					<a href="../amigos/fotos.php?id=<?php echo $id ?>" ><p class="font-weight-bold text-primary m-0"><i class="far fa-image"></i> Fotos: <?php echo count($res)?></p></a>
				</div>
				<div class="col">
					<p class="font-weight-bold text-primary m-0"><i class="fas fa-video"></i> Vídeos:0</p>
				</div>
				</div>
				
				
				
		</div>

		</div>



	</div>





<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px;">
				<div class="row">
					<h3 class="m-3 col-7">Postagens de <?php echo $nome;?>:</h3>
					<h3 class="text-primary ml-auto text-right m-3 col-3"><a href="../amigos/perfil.php?id=<?php echo $id; ?>"><i class="fas fa-sync-alt fa-2x"></i></a></h3>
				</div>

				<?php
				if($result){
					$i = 0;
					while ($i < count($result)) {
				
				?>


				<!-- post -->
			<div class="row p-0 m-0 justify-content-center mb-3">
			<div class="col p-0 m-0 bg-light border-top border-bottom" style="border-radius: 25px;">
				<div class="row mt-2" style=" vertical-align: middle;">
					<div class="col-2 text-right">
						<img class="img-fluid rounded-circle" style="height: 60px; width: 60px; object-fit: cover;" src="../img/users/profile<?php if ($profile){ echo $id; } else { echo "0";}?>.jpg">
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
						<h5 class=""><a href=""><i class="far fa-heart text-muted"></i></a> <a href=""><i class="fas fa-share-alt text-muted pl-3"></i></a></h5>
					</div>
				</div>
			</div>
			</div>
				<!-- fim post -->

		
			<?php $i++;
		}
		}
		else { ?>
			<div class="row m-2 justify-content-center">
				<div class="jumbotron w-100 text-center">
					<h3>Opa, <i><?php echo $nome;?></i> ainda não postou nada.</h3>
				</div>
			</div>

		<?php }
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








    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>