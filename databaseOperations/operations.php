<?php   
    class OperationBD{
        
        private $connectToBD;
        private $querys;
        private $connection;
        private $result;
        function __construct(){
            require_once('connect.php');
            $this->connectToBD = new ConectionBD();
            $this->connection = $this->connectToBD->getConnection();
        }
        public function consultUser($user,$password){
            $result_return = "";
            
            $this->querys = "SELECT * FROM user WHERE user_user='$user' AND password_user='$password';";
            $this->result = mysqli_query( $this->connection, $this->querys ) or die ( "something has gone wrong in the query");
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectToBD->closeConnection();
            
            return $result_return;
        }
    }
?>