<?php 
	
	class Midia {
		private $nome;
		private $legenda;

        public function __construct(){}

        public function getGaleria($pdo, $id){
            $stmt = $pdo->prepare('SELECT id, nome, legenda FROM fotos WHERE id_user = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $p = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $p;

    }


        public function uploadGaleria($pdo, $id_user, $legenda){
        	$id = '';
            $num = new DateTime();
            $num = $num->getTimestamp();
            $target_dir = "../img/users/galeria/";
            $target_name = 'galeria'.$id_user.'-'.$num;
            $target_file = $target_dir . $target_name . '.jpg';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				
				$stmt = $pdo->prepare('INSERT INTO fotos (id, id_user, nome, legenda) VALUES (?, ?, ?, ?) ');
            	$stmt->bindParam(1, $id, PDO::PARAM_INT);
            	$stmt->bindParam(2, $id_user, PDO::PARAM_INT);
            	$stmt->bindParam(3, $target_name, PDO::PARAM_STR);
            	$stmt->bindParam(4, $legenda, PDO::PARAM_STR);
            	
                $stmt->execute();

                return true;
        
            
            } else {
                
                return false;
            
            }


	   }

       public function removeGaleria($pdo, $nome){
        $stmt = $pdo->prepare('DELETE FROM fotos WHERE nome = ?');
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->execute();

        unlink("../img/users/galeria/".$nome.".jpg");
        
        return true;
       }






	}
