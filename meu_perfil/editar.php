<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Usuario.php';

$nome = $_POST['nome'];
$bio = $_POST['bio'];
$id = $_SESSION['id'];
$senha = $_POST['senha'];
$confsenha = $_POST['confsenha'];

$usuario = new Usuario;

if ($senha != "") {
	$senha = $usuario->mudaSenha($pdo, $id, $senha, $confsenha);
}

$result = $usuario->editarPerfil($pdo, $nome, $id, $bio);

if ($result) {
	header('location:../meu_perfil/meuperfil.php');
	$_SESSION['nome'] = $nome;
	$_SESSION['bio'] = $bio;
}