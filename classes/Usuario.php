<?php
    class Usuario {
        private $login;
        private $senha;
        private $email;
        private $nome;

        public function __construct(){}
        
        public function fazerLogin($pdo, $login, $senha){
            $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE login=? AND senha=?');
            $stmt->bindParam(1, $login, PDO::PARAM_STR);
            $stmt->bindParam(2, base64_encode($senha), PDO::PARAM_STR);
            $stmt->execute();
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = [true, $row['id']];
                return $result;
            }
            else {
                $result = [false, ''];
                return $result;
            }
        }

        public function getLogin($pdo, $id){
            $stmt = $pdo->prepare('SELECT login, email, nome, profile, bio FROM usuarios WHERE id=?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = [$row['login'], $row['email'], $row['nome'], $row['profile'], $row['bio']];
                return $result;
            }
            else{
                return false;
            }
        }


        public function cadastrar($pdo, $id, $login, $senha, $confsenha, $email, $nome, $profile){
            
            if ($this->verificaSenha($senha, $confsenha)){
                base64_encode($senha);
            $stmt = $pdo->prepare('INSERT INTO usuarios (id, login, senha, email, nome, profile) VALUES (?, ?, ?, ?, ?, ?) ');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $login, PDO::PARAM_STR);
            $stmt->bindParam(3, base64_encode($senha), PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $nome, PDO::PARAM_STR);
            $stmt->bindParam(6, $profile, PDO::PARAM_STR);
            $stmt->execute();
            return true;
            }
            else {
                return false;
            }
        }

        public function uploadProfile($pdo, $id){
            $target_dir = "../img/users/";
            $target_file = $target_dir . 'profile'.$_SESSION['id'].'.jpg';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                $stmt = $pdo->prepare('UPDATE usuarios SET profile = 1 WHERE id = ?');
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();

                $stmt = $pdo->prepare('UPDATE posts SET profile_user = 1 WHERE id_user = ?');
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();

                return true;

            } else {
                return false;
            }
            }
        



        public function uploadBG(){
            $target_dir = "../img/users/";
            $target_file = $target_dir . 'bg'.$_SESSION['id'].'.jpg';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    return true;
                } else {
                    return false;
                }
            }


        
        


        public function removerProfile($pdo, $id){
            $stmt = $pdo->prepare('UPDATE usuarios SET profile = 0 WHERE id = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $pdo->prepare('UPDATE posts SET profile_user = 0 WHERE id_user = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function removerBG($pdo, $id){

            unlink("../img/users/bg".$id.".jpg");
           
            return true;
        }





        public function editarPerfil($pdo, $nome, $id, $bio){
            $stmt = $pdo->prepare('UPDATE usuarios SET nome = ?, bio =? WHERE id = ?');
            $stmt->bindParam(1, $nome, PDO::PARAM_STR);
            $stmt->bindParam(2, $bio, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $pdo->prepare('UPDATE posts SET nome_user = ? WHERE id_user = ?');
            $stmt->bindParam(1, $nome, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        }


        public function mudaSenha($pdo, $id, $senha, $confsenha){

            if ($this->verificaSenha($senha, $confsenha)){
                $stmt = $pdo->prepare('UPDATE usuarios SET senha = ? WHERE id = ?');
                $stmt->bindParam(1, base64_encode($senha), PDO::PARAM_STR);
                $stmt->bindParam(2, $id, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        }


        private function verificaSenha($senha, $confsenha) {
            if ($senha == $confsenha) {
                return true;
            }
            else {
                return false;
            }

        }

        public function buscaUser($pdo, $busca){
            $stmt=$pdo->prepare("SELECT * FROM usuarios WHERE nome LIKE ? OR login LIKE ? " );
            $stmt->bindParam(1, $busca, PDO::PARAM_STR);
            $stmt->bindParam(2, $busca, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
            }




        public function getSeguindo($pdo, $id){
            $stmt=$pdo->prepare("SELECT id_seguido FROM relacao WHERE id_segue = ? AND aut = 1 " );
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getSeguidores($pdo, $id){
            $stmt=$pdo->prepare("SELECT id_segue FROM relacao WHERE id_seguido = ? AND aut = 1 " );
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getSolicitacoes($pdo, $id){
            $stmt=$pdo->prepare("SELECT id_segue FROM relacao WHERE id_seguido = ? AND aut = 0 " );
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function Autorizar($pdo, $id_segue, $id_seguido){
            $stmt=$pdo->prepare("UPDATE relacao SET aut = 1 WHERE id_segue = ? AND id_seguido = ?" );
            $stmt->bindParam(1, $id_segue, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_seguido, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function adicionarAmigo($pdo, $id, $id_segue, $id_seguido, $aut){
            $stmt = $pdo->prepare('INSERT INTO relacao (id, id_segue, id_seguido, aut) VALUES (?, ?, ?, ?) ');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_segue, PDO::PARAM_INT);
            $stmt->bindParam(3, $id_seguido, PDO::PARAM_INT);
            $stmt->bindParam(4, $aut, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
        }
        }

        public function removerAmigo($pdo, $id_segue, $id_seguido){
            $stmt = $pdo->prepare('DELETE FROM relacao WHERE id_segue = ? AND id_seguido = ?');
            $stmt->bindParam(1, $id_segue, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_seguido, PDO::PARAM_INT);
            $stmt->execute();
                return true;
        }






    
    }