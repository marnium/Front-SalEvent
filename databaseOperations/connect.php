<?php
    class ConectionDB{
        private static $servername = "localhost";
        private static $database = "sallevent";
        private static $username = "acceso";
        private static $password = "acceso";

        public static function get_connection(): mysqli {
            $connection = new mysqli(self::$servername, self::$username, self::$password, self::$database);
            if($connection->connect_error) {
                die("Connection failed: ".$connection->connect_error);
            }
            //echo "Connected successfully";
            return $connection;
        }
        private function __construct() {}
    }
?>
