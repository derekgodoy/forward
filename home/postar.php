<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Post.php';

    $id = "";
    $id_user = $_SESSION['id'];
    $nome_user = $_SESSION['nome'];
    $login_user = $_SESSION['login'];
    $post = $_POST['post'];
    $data = '';
    $profile_user = $_SESSION['profile'];

    $postagem = new Post();

    if ($postagem->setPost($pdo, $id, $id_user, $post, $nome_user, $login_user, $data, $profile_user)){
        header("location:{$_SERVER['HTTP_REFERER']}");
    }

