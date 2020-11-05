<?php 

    abstract class Connection{

        private static $conn;

        public static function getConn()
        {
            if(self::$conn == null)
            self::$conn = $conn = new PDO('mysql: host=localhost; dbname=phpmvc;','root','');

            return self::$conn;
        }

    }
    

?>