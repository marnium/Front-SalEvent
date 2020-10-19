<?php
    class ConectionBD{
        private $servername = "localhost";
        private $database = "sallevent";
        private $username = "acceso";
        private $password = "acceso";
        public $connection;
        function __construct(){
            $this->connection = mysqli_connect($this->servername,$this->username, 
                $this->password,$this->database);
            if (!$this->connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            echo "Connected successfully";
        }
        public function getConnection(){
            return $this->connection;
        }
        public function closeConnection(){
            mysqli_close($this->connection);
        }
    }
?>
