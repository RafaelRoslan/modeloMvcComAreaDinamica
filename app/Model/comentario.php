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

    }

?>