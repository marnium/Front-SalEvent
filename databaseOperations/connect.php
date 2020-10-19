<?php
    class ConectionBD{
        private $servername = "localhost";
        private $database = "sallevent";
        private $username = "acceso";
        private $password = "acceso";
        public $conn;
        function __construct(){
            $this->conn = mysqli_connect($this->servername,$this->username, 
                $this->password,$this->database);
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            echo "Connected successfully";
        }
        public function getConnection(){
            if ($this->conn) {echo 'enviando conexion';}
            return $this->conn;
        }
        public function closeConnection(){
            mysqli_close($this->conn);
        }
    }
?>
