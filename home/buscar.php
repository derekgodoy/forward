<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Post.php';
require '../Classes/Midia.php';
if (isset($_POST['busca'])) {
	$_SESSION['busca'] = $_POST['busca'];
	header('location:buscar.php'); }
$busca = "%".$_SESSION['busca']."%";
$busca2 = $_SESSION['busca'];

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Forward - Busca</title>
    <link rel="icon" href="../img/logo1.png">
  </head>

  <body class="bg-dark" style="background-image: url(../img/users/bg<?php echo $_SESSION['id']?>.jpg); background-size:cover; background-attachment: fixed;">
  	
  	<?php include '../modulos/nav.php' ?>

	<div class="container mt-5 justify-content-center bg-light col-xl-6 mb-5" style="border-radius: 10px;">
				<div class="row">
					<h3 class="m-3 col">Resultados da busca: "<?php echo $busca2?>" </h3>
					
				</div>
				<div class="row justify-content-center">

				<?php
				$buscar = new Usuario;
				$result = $buscar->buscaUser($pdo, $busca);
				if($result){
				$i = 0;
				while ($i < count($result)) {
				// $galeria = new Midia;
				// $fotos = $galeria->getGaleria($pdo, $result[$i]['id']);
				// $postagens = new Post;
				// $posts = $postagens->getYourPosts($pdo, $result[$i]['id']);
				
				?>
				<!-- resultado -->

					<div class="card text-center m-2" style="width: 14rem; border-radius: 20px;">
					  <div class="row justify-content-center mt-2"> <a href="../amigos/perfil.php?id=<?php echo $result[$i]['id']; ?>" style="text-decoration: none;">
					  <img class="card-img-top img-fluid rounded-circle" style="height: 100px; width: 100px; object-fit: cover;" src="../img/users/profile<?php if ($result[$i]['profile']){ echo $result[$i]['id']; } else { echo "0";}?>.jpg">
					  </div>
					  <div class="card-body">
						<p><b><?php echo $result[$i]['nome']?></b></p> </a>
						<p><b><i class="fas fa-at"></i><?php echo $result[$i]['login']?></b></p>
						<p class="text-muted"><?php if($result[$i]['bio']){echo "<i class='fas fa-xs fa-quote-left'></i> ".$result[$i]['bio']." <i class='fas fa-xs fa-quote-right'></i>";}else{echo "  ";}?></p>
						<form action="../amigos/adicionar.php" method="post">
							<input type="hidden" name="id_seguido" id="id_seguido" value="<?php echo $result[$i]['id'] ?>">

							<?php 

							$arr = [];
							$amizades = new Usuario;
							if ($result[$i]['id']==$_SESSION['id']) {
								echo " ";
							}else{
							if($amigos = $amizades->getSeguindo($pdo, $_SESSION['id'])){
							foreach ($amigos as $am) {
								array_push($arr, $am['id_seguido']);
							}
							if (in_array($result[$i]['id'], $arr)) {

							?>

							<button formaction="../amigos/removeramigo.php" class="btn btn-outline-danger" style="border-radius: 15px;">Deixar de seguir</button>

						<?php }  else{ ?>


							<button type="sumbit" class="btn btn-outline-primary" style="border-radius: 15px;">+ Seguir</button>

						<?php }
					} else {
						 ?>
						 <button type="sumbit" class="btn btn-outline-primary" style="border-radius: 15px;">+ Seguir</button>
						<?php }
						} ?>
							</form>


				      </div>
					</div>
					
				<!-- fim resultado -->

		
			<?php $i++;
		}?>
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