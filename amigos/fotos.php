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
				$result = $postagens->getYourPosts($pdo, $id);
				 ?>

	<div class="col-2 bg-light mt-5 position-fixed ml-5" style="border-radius: 15px;">
			
		<div class="row mt-2">
			<div class="col text-center">
				<a class="navbar-brand p-0 m-0 pr-2" href="perfil.php?id=<?php echo $id; ?>"><img class="img rounded-circle" style="height: 150px; width: 150px; object-fit: cover;" src="../img/users/profile<?php if ($profile){ echo $id; } else { echo "0";}?>.jpg"></a>
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

				$amizades = new Usuario;
				if($amigos = $amizades->getSeguindo($pdo, $_SESSION['id'])){
				$arr = [];
				foreach ($amigos as $am) {
					array_push($arr, $am['id_seguido']);
				}

				if (in_array($id, $arr)) {

				?>

				<button formaction="../amigos/removeramigo.php" class="btn btn-outline-danger" style="border-radius: 15px;">Deixar de seguir</button>

			<?php } else{ ?>


				<button type="sumbit" class="btn btn-outline-primary" style="border-radius: 15px;">+ Seguir</button>

			<?php }
			} ?>
				</form>
			</div>
		</div>

		<div class="text-center mt-2 mb-2">
		
				<a href="../amigos/perfil.php?id=<?php echo $id ?>" ><p class="font-weight-bold text-primary m-0" >Posts: <?php echo count($result) ?></p></a>
			
				<div class="row mt-3">
				<div class="col">
					<p class="font-weight-bold text-primary m-0" >Seguidores: 45</p>
				</div>
				<div class="col">
					<p class="font-weight-bold text-primary m-0" >Seguindo: 45</p>
				</div>
				</div>
			

			<?php $galeria = new Midia;
			$res = $galeria->getGaleria($pdo, $id); ?>
				
				<div class="row mt-3">
				<div class="col">
					<p class="font-weight-bold text-primary m-0"><i class="far fa-image"></i> Fotos: <?php echo count($res)?></p>
				</div>
				<div class="col">
					<p class="font-weight-bold text-primary m-0"><i class="fas fa-video"></i> Vídeos:0</p>
				</div>
				</div>

				
				
		</div>




	</div>





<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px;">
				<div class="row">
					<h3 class="m-3 col-7">Fotos de <?php echo $nome;?>:</h3>
					<h3 class="text-primary ml-auto text-right m-3 col-3"><a href="#"><i class="fas fa-sync-alt fa-2x"></i></a></h3>
				</div>



			<div class="row justify-content-center mt-2">
				<?php 
					if ($res) {
						$i = 0;
						while ($i < count($res)) {
				?>
					<div class="col mb-3 text-center">
						<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $res[$i]['legenda']?>" data-image="../img/users/galeria/<?php echo $res[$i]['nome']?>.jpg" data-target="#image-gallery">
					<figure class="figure ">
						<img src="../img/users/galeria/<?php echo $res[$i]['nome']?>.jpg" style="width: 280px; height: 280px; object-fit: cover; border-radius: 10px;">
					</figure> </a>
				</div>


					<?php
					$i++;
					}
					} else {
					?>


					<div class="jumbotron w-100 text-center m-4">
				<h3> <?php echo $nome ?> ainda não postou nenhuma foto.</h3>
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

    <?php } ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="../js/gallery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
