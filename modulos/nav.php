<div class="container rounded">

<nav class="navbar navbar-expand-xl navbar-light bg-light" style="border-radius: 25px;">
		  <a class="navbar-brand p-0 m-0 pr-2" href="../meu_perfil/meuperfil.php"><img class="img rounded-circle" style="height: 40px; width: 40px; object-fit: cover;" src="../img/users/profile<?php if ($_SESSION['profile']){ echo $_SESSION['id']; } else { echo "0";}?>.jpg"></a>

		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse " id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto text-bold ">
		      <li class="nav-item ">
		        <a class="nav-link" href="../meu_perfil/meuperfil.php"><h5 class="text-dark p-0 m-0"><i class="fas fa-at"></i><?php echo $_SESSION['login'] ?></h5></a>
		      <li class="nav-item ">
		        <a class="nav-link" href="../home/home.php"><h5 class="text-dark p-0 m-0"><i class="fas fa-home"></i> Home</h5></a>
		      </li>
		      <li class="nav-item ">
		        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal3"><h5 class="text-primary p-0 m-0"><i class="fas fa-plus"></i> Novo post</h5></a>
		      </li>

		    </ul>
		    <form class="form-inline my-2 my-lg-0" action="../home/buscar.php" method="post">
		      <i class="fas fa-forward fa-2x mr-2"></i>
		      <input class="form-control mr-sm-2" type="search" placeholder="Busca" id="busca" name="busca" style="border-radius: 25px">
		    </form>
			<div class="dropdown">
			  <button class="btn btn-outline-secondary dropdown-toggle" style="height: 4%; border-radius: 25px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
			    <a class="dropdown-item text-danger" href="../home/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
			    <a class="dropdown-item" href="../meu_perfil/meuperfil.php"><i class="fas fa-user"></i> Perfil</a>
			    <a class="dropdown-item" href="../meu_perfil/editaperfil.php"><i class="fas fa-user-edit"></i> Editar perfil</a>
				<div class="dropdown-divider"></div>
			    <a class="dropdown-item" href="#"><i class="fas fa-info-circle"></i> Sobre</a>
			  </div>
			</div>
		  </div>
		</nav>
		
	</div>