<?php
session_start();
require '../conexao.php';
require '../Classes/Usuario.php';
require '../Classes/Midia.php';

$tipo = $_POST['tipo'];
$legenda = $_POST['legenda'];
$id = $_SESSION['id'];
$upload = new Usuario;
$upload2 = new Midia;

if ($tipo == 1){
	$result = $upload->uploadProfile($pdo, $id);
	$_SESSION['profile'] = 1;  

} if ($tipo == 2){
	$result = $upload->uploadBG();

} if ($tipo == 3){
	$result = $upload2->uploadGaleria($pdo, $id, $legenda);
	
} else {

    header("location:{$_SERVER['HTTP_REFERER']}");
}

if ($result){
    header("location:{$_SERVER['HTTP_REFERER']}");
} else {
	
    header("location:{$_SERVER['HTTP_REFERER']}");
}



?>