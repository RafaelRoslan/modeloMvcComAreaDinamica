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

        public static function insert($dados){

            if(empty($dados['titulo']) || empty($dados['conteudo'])){
                throw new Exception("Preencha todos os campos!");
                return false;
            }

            $conn = Connection::getConn();

            $query = 'INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)';
            $query = $conn->prepare($query);
            $query->bindValue(':tit', $dados['titulo']);
            $query->bindValue(':cont', $dados['conteudo']);
            
            $verif =  $query->execute();

            if(!$verif){
                throw new Exception("Falha ao postar publicação!");
                return false;
            }
            
            return true;

        }

        public static function update($dados){

            if(empty($dados['titulo']) || empty($dados['conteudo'])){
                throw new Exception("Preencha todos os campos!");
                return false;
            }
            $conn = Connection::getConn();

            $query = 'UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id_post = :id';
            $query = $conn->prepare($query);
            $query->bindValue(':tit', $dados['titulo']);
            $query->bindValue(':cont', $dados['conteudo']);
            $query->bindValue(':id', $dados['id_post']);
            
            $verif =  $query->execute();
            
            if(!$verif){
                throw new Exception("Falha ao atualizar publicação!");
                return false;
            }
            
            return true;

        }

        public static function delete($id_post){
            $conn = Connection::getConn();

            $query = 'DELETE FROM postagem WHERE id_post = :id';
            $query = $conn->prepare($query);
            $query->bindValue(':id',$id_post, PDO::PARAM_INT);

            $verif = $query->execute();

            if(!$verif){
                throw new Exception("Falha deletar publicação!");
                return false;
            }

            return true;

        }

    }

?>