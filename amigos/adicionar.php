<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Usuario.php';

    $id_seguido = $_POST['id_seguido'];
    $id_segue = $_SESSION['id'];
    $aut = 1;
    $id = "";

    $add = new Usuario;

   	if ($add->adicionarAmigo($pdo, $id, $id_segue, $id_seguido, $aut)){
   		header("location:{$_SERVER['HTTP_REFERER']}");
   	} 
   	