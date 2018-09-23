<?php
    require '../conexao.php';
    require '../Classes/Usuario.php';

    $id = '';
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $profile = 0;

    $usuario = new Usuario();
    $a = $usuario->cadastrar($pdo, $id, $login, $senha, $confsenha, $email, $nome, $profile);
    if ($a) {
        
    header('location:../cadastro/cadastrosuc.php');
    }