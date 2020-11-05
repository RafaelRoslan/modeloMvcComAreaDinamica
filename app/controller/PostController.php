<?php

    class PostController{

        public function index($params){
            try {

                $postagem = Postagem::selecionarPost($params);

                $loader   = new Twig\Loader\FilesystemLoader('app/View');
                $twig     = new \Twig\Environment($loader);
                $template = $twig->load('single.html');
 

                $parametros = array();
                $parametros['id']          = $postagem->id_post;
                $parametros['titulo']      = $postagem->titulo;
                $parametros['conteudo']    = $postagem->conteudo;
                $parametros['comentarios'] = $postagem->comentario;
                
                $conteudo = $template->render($parametros);
                echo $conteudo;


            } catch (Exception $th) {
                echo $th->getMessage();
            }
        }

        public function addComent(){
            try {
                
                Comentario::insert($_POST);
                header('location: http://localhost/php_MVC/?pagina=post&id='.$_POST['id']);

            } catch (Exception $e) {
                echo '<script>alert("Publicacao atualizada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=post&id='.$_POST['id'].'";</script>';
            }
            
        }


    }

?>