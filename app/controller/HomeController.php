<?php

    class HomeController{

        public function index(){
            try {
                $colecao = Postagem::mostrarPostagem();

                $loader = new Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $parametros = array();
                $parametros['postagens'] = $colecao;

                $conteudo = $template->render($parametros);
                echo $conteudo;

            } catch (Exception $th) {
                echo $th->getMessage();
            }
        }

    }

?>