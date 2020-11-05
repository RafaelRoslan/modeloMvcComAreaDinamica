<?php

    class Core{

        public function start($urlGet){

            //nome do metodo do Controller, o index()
            if(!isset($urlGet['metodo']))
                $action = 'index';
            else
                $action = $urlGet['metodo'];

            if(!isset($urlGet['pagina'])){
                $controller = 'HomeController';
            }
            else
                $controller = ucfirst($urlGet['pagina']).'Controller';
            

            if(!class_exists($controller))
               $controller = 'ErroController';

            if(isset($urlGet['id']) && $urlGet['id'] != null)
                $id = $urlGet['id'];
            else
                $id = null;

            call_user_func_array(array(new $controller, $action), array('id'=> $id));
        }

    }

?>