<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Usuario.php';

    if($_POST['id_seguido']){
    $id_seguido = $_POST['id_seguido'];
    $id_segue = $_SESSION['id'];
    }
    if($_POST['id_segue']){
    $id_segue = $_POST['id_segue'];
    $id_seguido = $_SESSION['id'];
    }
    $rem = new Usuario;

   	if ($rem->removerAmigo($pdo, $id_segue, $id_seguido)){
   		header("location:{$_SERVER['HTTP_REFERER']}");
   	} 
   	