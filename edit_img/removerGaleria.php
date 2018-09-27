<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Midia.php';

$nome = $_POST['nome'];

$remove = new Midia;

$result = $remove->removeGaleria($pdo, $nome);

if ($result) {
	 header("location:{$_SERVER['HTTP_REFERER']}");
}