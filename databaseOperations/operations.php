<?php   
    class OperationBD{
        
        private $conectar;
        private $consultas;
        private $conexion;
        private $resultado;
        function __construct(){
            require_once('connect.php');
            $this->conectar = new ConectionBD();
            $this->conexion = $this->conectar->getConnection();
        }
        public function consultUser($user,$password){
            $resultadoregresar = "no hay nada";
            $this->consultas = "SELECT * FROM user;";
            $this->resultado = mysqli_query( $this->conexion, $this->consultas ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while($columna = mysqli_fetch_array( $this->resultado )){
                if($user==$columna['user_user'] && $password==$columna['password_user']){
                    $resultadoregresar = $columna['id_user']."-".$columna['type_user']."-".$columna['user_user']."-".$columna['password_user'];
                }
            }
            $this->conectar->closeConnection();
            return $resultadoregresar;
        }
    }
?>