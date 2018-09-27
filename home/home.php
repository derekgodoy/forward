<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Post.php';
$usuario = new Usuario;
$id = $_SESSION['id'];
$result = $usuario->getLogin($pdo, $id);
 if ($result) {
        $_SESSION['login'] = $result[0];
        $_SESSION['email'] = $result[1];
        $_SESSION['nome'] = $result[2];
        $_SESSION['profile'] = $result[3];  
        $_SESSION['bio'] = $result[4];  
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Forward - Home</title>
    <link rel="icon" href="../img/logo1.png">
  </head>

  <body class="bg-dark" style="background-image: url(../img/users/bg<?php echo $_SESSION['id']?>.jpg); background-size:cover; background-attachment: fixed;">
  	
    
	<?php include '../modulos/nav.php' ?>
		

	<div class="container mt-5 justify-content-center bg-light col-6 mb-5 pb-3" style="border-radius: 10px;">
				<div class="row">
					<h3 class="m-3 col-5">Sua timeline:</h3>
					<h3 class="text-primary ml-auto text-right m-4 col-3 "><a href="home.php"><i class="fas fa-sync-alt fa-lg"></i></a></h3>
				</div>

				<?php 
				$postagens = new Post;
				$amizades = new Usuario;
				$result = $postagens->getAllPosts($pdo);
				
				$check = [];
				$arr = [];
				array_push($arr, $_SESSION['id']);

				if($amigos = $amizades->getSeguindo($pdo, $_SESSION['id'])){
				
					foreach ($amigos as $am) {
						array_push($arr, $am['id_seguido']);
					}
				}
				foreach($result as $res){
				array_push($check, $res['id_user']);
				}
				if (in_array($_SESSION['id'], $check) or $amigos) {

				$i = 0;
				while ($i < count($result)) {
					 if (in_array($result[$i]['id_user'], $arr)) {
				$comentarios = $postagens->getComentarios($pdo, $result[$i]['id']);
				?>


				<!-- post -->
			<a id="<?php echo $result[$i]['id']; ?>"><div class="row p-0 m-0 justify-content-center mb-3"> </a>
			<div class="col p-0 m-0 bg-light border-top border-bottom" style="border-radius: 25px;">
				<div class="row mt-2" style=" vertical-align: middle;">
					<div class="col-2 text-right">
						<a href="../amigos/perfil.php?id=<?php echo $result[$i]['id_user']; ?>" class="text-dark"	style="text-decoration: none;"><img class="img-fluid rounded-circle" style="height: 60px; width: 60px; object-fit: cover;" src="../img/users/profile<?php if ($result[$i]['profile_user']){ echo $result[$i]['id_user']; } else { echo "0";}?>.jpg">
					</div>
					<div class="col-6 align-middle">
						<h5 class="m-0 pt-2"><?php echo $result[$i]['nome_user']; ?></h5>
						<p class="m-0 text-muted">@<?php echo $result[$i]['login_user']; ?></p></a>
					</div>
					<div class="col-3 m-3">

						<?php if ($_SESSION['id'] == $result[$i]['id_user']){ ?>
							<div class="col bg-light rounded position-absolute collapse text-center m-0 " id="coll<?php echo $result[$i]['id']; ?>">
								<div>
									<div>
							  <p class=" text-danger m-0">Deletar post?</p>
									</div>
									<div class="text-center">
							  <a class="text-center mr-1" href="../home/removePost.php?id=<?php echo $result[$i]['id']; ?>"><i class="fas text-success fa-check"></i></a>
							  <a data-toggle="collapse" href="#coll<?php echo $result[$i]['id']; ?>" role="button" class="text-center ml-1"><i class="fas fa-times text-danger"></i></a>
									</div>
								</div>

							</div>
						<a  data-toggle="collapse" href="#coll<?php echo $result[$i]['id']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-times text-muted float-right mr-2 mt-2"></i></a>

						<?php } else {?>

							<form action="../amigos/removeramigo.php" method="post">
									<input type="hidden" name="id_seguido" id="id_seguido" value="<?php echo $result[$i]['id_user'] ?>">
									<button class="btn btn-outline-danger btn-sm float-right mr-0 mb-2" style="margin-right: 09%; border-radius: 15px;">Deixar de seguir</button> 
								</form>
						<?php } ?>
						</div>
				</div>
				<div class="row justify-content-center mt-4">
					<div class="col-8 jumbotron" style="word-break: break-all;">
						<p><?php echo $result[$i]['post']; ?></p>
					</div> 
				</div>
				<div class="row justify-content-center mb-1">
					<div class="col-10">
						<div class="row">
							<div class="col mt-1">
								<a href="" class="align-middle"><i class="far fa-heart text-muted"></i></a>
								<a data-toggle="collapse" href="#comments<?php echo $result[$i]['id'];?>" role="button" aria-expanded="false" aria-controls="comments" class="text-muted align-middle" style="text-decoration: none;"><i class="far fa-comment text-muted pl-3"></i> <span class="align-top"><?php if($comentarios){echo count($comentarios);} else { echo "0";} ?></span></a> 
							</div>

						
					<div class="col-3" >
						<p class="text-muted m-0 text-right" style="font-size: 11px;"><?php $date = date_create($result[$i]['data']); echo date_format($date, 'd/m'); ?></p>
						<p class="text-muted m-0 text-right" style="font-size: 11px;"><?php echo date_format($date, 'H:i'); ?></p>
					</div>

					</div>

						<!-- comentarios -->

						<div class="collapse" id="comments<?php echo $result[$i]['id'];?>">
						  <div class="card-body">

						  	<div class="row">
						  		<div class="col-1 p-0">
						  			<img class="img rounded-circle" style="height: 30px; width: 30px; object-fit: cover;" src="../img/users/profile<?php if ($_SESSION['profile']){ echo $_SESSION['id']; } else { echo "0";}?>.jpg">
						  		</div>
							  <div class="form-group col w-100 p-0">
						  		<form action="../home/comentar.php" method="post">
							    <textarea class="form-control" id="comentario" name="comentario" placeholder="Comente algo!" maxlength="140" rows="1"></textarea>
							  </div>
						  		<div class="col-1 p-0 pl-1 m-1">
						  			<input type="hidden" name="id_post" id="id_post" value="<?php echo $result[$i]['id'] ?>">
						  			<button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-right"></i></button>
						  			</form>
						  		</div>
						  	</div>


						  		<?php 
						  	if($comentarios){
						  	foreach ($comentarios as $com) {
						  		$data = date_create($com['data']);
						  		$data = date_format($data, 'd/m H:i');
						  		$info = $usuario->getLogin($pdo, $com['id_user']);
						  		if ($info) {
							        $login = $info[0];
							        $email = $info[1];
							        $nome = $info[2];
							        $profile = $info[3];  
							        $bio = $info[4];	}				  			
						  	 ?>

						  	<div class="row mb-2">
						  	 	<div class="col-1">
						  	 		<img class="img rounded-circle" style="height: 30px; width: 30px; object-fit: cover;" src="../img/users/profile<?php if($profile){echo $com['id_user'];}else{echo '0';}?>.jpg">
						  	 	</div>
						  	 	<div class="col-9 card ml-2">
						  	 		<p><?php echo $nome ?>:</p>
						  	 		<p><?php echo $com['comentario'] ?></p>
						  	 	</div>
						  	 	<div class="col ">
						  	 		<p class="text-muted mb-0" style="font-size: 10px;"><?php echo $data ?></p>
						  	 		<!-- <i class="fas fa-times fa-sm text-muted"></i> -->
						  	 	</div>




						  	</div>
						  	<?php }
						  	} ?>

						  		



						  </div>
						</div>

						<!-- fim comentarios -->




				</div>
			</div>
			</div>
			</div>
				<!-- fim post -->

		
			<?php } $i++;
		 }
		 } else { ?>

		 	<div class="m-2 jumbotron text-center">
		 		<h5>Poste alguma coisa ou adicione um amigo!</h5>
		 	</div>

		<?php } ?>

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
									  <textarea  class="form-control" id="post" name="post" aria-describedby="post" placeholder="Escreva aqui!" style="border-radius: 25px" rows="3" maxlength="140" required></textarea>
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