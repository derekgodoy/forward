<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Post.php';

    $id = "";
    $id_post = $_POST['id_post'];
    $id_user = $_SESSION['id'];
    $comentario = $_POST['comentario'];

    $comentar = new Post();

    if ($comentar->Comentar($pdo, $id, $id_post, $id_user, $comentario)){
        header("location:{$_SERVER['HTTP_REFERER']}");
    }
