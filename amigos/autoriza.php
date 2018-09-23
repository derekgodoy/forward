<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Usuario.php';

    $id_segue = $_POST['id_segue'];
    $id_seguido = $_SESSION['id'];

    $aut = new Usuario;

   	$aut->Autorizar($pdo, $id_segue, $id_seguido);
   	
    header("location:{$_SERVER['HTTP_REFERER']}");
   	 