<?php   
    class OperationBD{
        private $connectDB;
        private $querys;
        private $result;

        function __construct() {
            require_once('connect.php');
            $this->connectDB = ConectionDB::get_connection();
        }
        
        public function consultUser($user,$password){
            $result_return = "";
            
            $this->querys = "SELECT * FROM user WHERE user_user='$user' AND password_user='$password';";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectDB->close();
            return $result_return;
        }

        /**
         * This method adds a record for a user in the user table.
         */
        public function create_user($name_user, $pa_lastname_user, $mo_lastname_user,
            $email_user, $phone_user, $user_user, $password_user): array {
            if($this->user_exists($user_user)) {
                $query_status['message'] = "El usuario $user_user ya existe, especifique otro usuario";
                $query_status['status'] = false;
                $this->connectDB->close();
                return $query_status;
            }
            $this->querys = "INSERT INTO user VALUES(null,1,'$name_user','$pa_lastname_user','$mo_lastname_user','$email_user',".
                "'$phone_user','$user_user','$password_user')";

            $query_status = array('message'=>"¡Felicidades! $name_user, has sido registrado exitosamente. Por favor inicia sesión",'status'=>true);
            if($this->connectDB->query($this->querys) === FALSE) {
                $query_status['message'] = "Ocurrió un error al registrarte $name_user, por favor vuelve a intentarlo.";
                $query_status['status'] = false;
            }
            $this->connectDB->close();
            return $query_status;
        }
        /**
         * This method checks if the user indicated by $user
         * exists in the user table.
         * Warning: the method does not close the connection
         * to the database.
         */
        public function user_exists(string $user): bool {
            if($this->connectDB->query("SELECT id_user FROM user WHERE user_user='$user'")->num_rows > 0) {
                return true;
            }
            return false;
        }
    }
?>