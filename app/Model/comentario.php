<?php

    class Comentario{

        public static function selecComentario($idPost){

            $conn = Connection::getConn();

            $query = "SELECT * FROM comentario WHERE id_post = :id";
            $query = $conn->prepare($query);
            $query->bindValue(':id', $idPost,PDO::PARAM_INT);
            $query->execute();

            $result = array();

            while($row = $query->fetchObject('Comentario')){
                $result[] = $row;
            }

            return $result;

        }

        public static function insert($coment){

            $conn = Connection::getConn();

            $query = 'INSERT INTO comentario (nome, menssagem, id_post) VALUES (:nom, :msg, :idp)';
            $query = $conn->prepare($query);
            $query->bindValue(':nom', $coment['nome']);
            $query->bindValue(':msg', $coment['msg']);
            $query->bindValue(':idp', $coment['id']);
            
            $verif = $query->execute();

            if(!$verif){

                throw new Exception("Falha em adicionar o comentario!");
                return false;

            }

            return true;
            
        }

    }

?>