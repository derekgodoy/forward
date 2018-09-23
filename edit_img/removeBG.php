<?php
    session_start();
    require ';;/conexao.php';
    require '../Classes/Usuario.php';

$id = $_SESSION['id'];

$usuario = new Usuario;

$result = $usuario->removerBG($pdo, $id);

if ($result) {
	header('location:../meu_perfil/editaperfil.php');
}