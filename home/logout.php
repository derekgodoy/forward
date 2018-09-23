<?php
session_start();
include "../conexao.php";
session_destroy();
header("location: ../index.php");
	exit;
?>