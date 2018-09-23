<?php

	class Post {
		private $id;
		private $id_user;
		private $texto;
		private $data;
		private $nome_user;
		private $login_user;
		private $profile_user;

		public function __construct() {}

		public function setPost($pdo, $id, $id_user, $texto, $nome_user, $login_user, $data, $profile_user){

			$stmt = $pdo->prepare('INSERT INTO posts (id, id_user, post, nome_user, login_user, profile_user) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_user, PDO::PARAM_INT);
            $stmt->bindParam(3, $texto, PDO::PARAM_STR);
            $stmt->bindParam(4, $nome_user, PDO::PARAM_STR);
            $stmt->bindParam(5, $login_user, PDO::PARAM_STR);
            $stmt->bindParam(6, $profile_user, PDO::PARAM_STR);
 			$stmt->execute();

 			return true;
		}

		public function getAllPosts($pdo){
            $stmt = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
 			$stmt->execute();

 			if($r = $stmt->fetchAll(PDO::FETCH_ASSOC)){
 				return $r;				
 			} else { return $r;}
		}


		public function getYourPosts($pdo, $id){
			$stmt = $pdo->prepare('SELECT * FROM posts WHERE id_user = ? ORDER BY id DESC');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();

			if($p = $stmt->fetchAll(PDO::FETCH_ASSOC)){
				return $p;
			} else{ return $p;}
		}

		public function removePost($pdo, $id){
			$stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $pdo->prepare('DELETE FROM comentarios WHERE id_post = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			
			return true;
		}

		public function Comentar($pdo, $id, $id_post, $id_user, $comentario){
			$stmt = $pdo->prepare('INSERT INTO comentarios(id, id_post, id_user, comentario) VALUES (?, ?, ?, ?)');
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->bindParam(2, $id_post, PDO::PARAM_INT);
			$stmt->bindParam(3, $id_user, PDO::PARAM_INT);
			$stmt->bindParam(4, $comentario, PDO::PARAM_STR);
			$stmt->execute();

 			return true;
		}

		public function getComentarios($pdo, $id){
			$stmt = $pdo->prepare('SELECT id_user, comentario, data FROM comentarios WHERE id_post = ?');
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();

			if($result = $stmt->fetchAll(PDO::FETCH_ASSOC)){
				return $result;
			} else {
				return false;
			}
		}

	}
