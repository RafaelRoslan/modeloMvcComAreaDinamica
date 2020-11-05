<?php

    class Postagem{

        public static function mostrarPostagem(){
            $conn = Connection::getConn();

            $query = "SELECT * FROM postagem ORDER BY id_post DESC";
            $query = $conn->prepare($query);
            $query->execute();

            $result = array();

            while($row = $query->fetchObject('Postagem')){
                $result[] = $row;
            }

            if(!$result){
                throw new Exception("Não foi encontrado nenhuma Postagem");
            }

            return $result;

        }

        public static function selecionarPost($idPost){
            $conn = Connection::getConn();
            
            $query = "SELECT * FROM postagem WHERE id_post = :id";
            $query = $conn->prepare($query);
            $query->bindValue(':id', $idPost, PDO::PARAM_INT);
            $query->execute();

            $result = $query->fetchObject('Postagem');
            
            if(!$result){
                throw new Exception("Não foi encontrado nenhuma Postagem");
            }else{
                $result->comentario = Comentario::selecComentario($result->id_post);
            }

            return $result;

        }
    }

?>