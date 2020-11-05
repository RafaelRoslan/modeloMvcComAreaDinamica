<?php

    require_once 'app/core/core.php';

    require_once 'lib/DataBase/Conexao.php';

    require_once 'app/controller/HomeController.php';
    require_once 'app/controller/PostController.php';
    require_once 'app/controller/ErroController.php';
    require_once 'app/controller/SobreController.php';
    require_once 'app/controller/AdminController.php';

    require_once 'app/Model/Postagem.php';
    require_once 'app/Model/comentario.php';

    require_once 'vendor/autoload.php';

    
    $template = file_get_contents('app/template/estrutura.html');

    ob_start();
        $core = new Core;
        $core->start($_GET);

        $saida = ob_get_contents();

    ob_end_clean();
    //var_dump($saida);
    $_template = str_replace('{{area_dinamica}}',$saida,$template);

    echo $_template;

?>