<?php
    session_start();
    require '../conexao.php';
    require '../Classes/Post.php';

$id = $_GET['id'];

$remove = new Post;

$result = $remove->removePost($pdo, $id);

if ($result) {
	 header("location:{$_SERVER['HTTP_REFERER']}");
}