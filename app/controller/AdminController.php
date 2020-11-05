<?php

    class AdminController{

        public function index(){
            
                $loader   = new Twig\Loader\FilesystemLoader('app/View');
                $twig     = new \Twig\Environment($loader);
                $template = $twig->load('admin.html');

                $objPost = Postagem::mostrarPostagem();

                $parametros = array();
                $parametros['postagens'] = $objPost;
                
                $conteudo = $template->render($parametros);
                echo $conteudo;

        }

        public function create(){

            $loader   = new Twig\Loader\FilesystemLoader('app/View');
            $twig     = new \Twig\Environment($loader);
            $template = $twig->load('create.html');

            $parametros = array();
            
            $conteudo = $template->render($parametros);

            echo $conteudo;
            
        }

        public function insert(){

            try {
                Postagem::insert($_POST);
                echo '<script>alert("Publicacao inserida com sucesso!");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=index";</script>';
                
            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=create";</script>';

            }
            
        }

        public function editPost($id_post){
            $loader   = new Twig\Loader\FilesystemLoader('app/View');
            $twig     = new \Twig\Environment($loader);
            $template = $twig->load('update.html');

            $post = Postagem::selecionarPost($id_post);

            $parametros = array();

            $parametros['id']       = $post->id_post;
            $parametros['titulo']   = $post->titulo;
            $parametros['conteudo'] = $post->conteudo;
            
            $conteudo = $template->render($parametros);

            echo $conteudo;

        }

        public function update(){

            try {
                Postagem::update($_POST);
                echo '<script>alert("Publicacao atualizada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=index";</script>';

            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=editPost&id='.$_POST["id_post"].'";</script>';
                
            }

        }

        public function delete($id_post){

            try {
                Postagem::delete($id_post);
                echo '<script>alert("Publicacao deletada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=index";</script>';

            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/php_MVC/?pagina=admin&metodo=index";</script>';
                
            }

        }


    }

?>