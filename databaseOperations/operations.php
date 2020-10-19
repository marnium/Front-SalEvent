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
            $this->result = mysqli_query( $this->connection, $this->querys ) or die ( "something has gone wrong in the query");
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectToBD->closeConnection();
            
            return $result_return;
        }

        /**
         * This method adds a record for a user in the user table.
         */
        public function create_user($name_user, $pa_lastname_user, $mo_lastname_user,
            $email_user, $phone_user, $user_user, $password_user): array {
            if($this->user_exists($user_user)) {
                $query_status['message'] = 'User has already been created';
                $query_status['status'] = false;
                $this->connectDB->close();
                return $query_status;
            }
            $this->querys = "INSERT INTO user VALUES(0,1,'$name_user','$pa_lastname_user','$mo_lastname_user','$email_user',".
                "'$phone_user','$user_user','$password_user')";

            $query_status = array('message'=>'User successfully registered','status'=>true);
            if($this->connectDB->query($this->querys) === FALSE) {
                $query_status['message'] = 'Error: user could not be registered';
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
            $result = $this->connectDB->query("SELECT id_user FROM user WHERE user_user='$user'");
            if($result->num_rows > 0) {
                echo '<p>El usuario existe</p>';
                return true;
            }
            return false;
        }
    }
?>