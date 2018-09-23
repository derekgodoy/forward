<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Usuario.php';

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $usuario = new Usuario();

    $result = $usuario->fazerLogin($pdo, $login, $senha);

    if ($result[0]) {
        $_SESSION['id'] = $result[1];
    	header('location:../home/home.php');
    } else {
    	header('location:../home/erro.php');
    }