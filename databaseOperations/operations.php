<?php   
    class OperationBD{
        private $connectDB;
        private $querys;
        private $result;

        function __construct() {
            require_once('connect.php');
            $this->connectDB = ConectionDB::get_connection();
        }
        
        public function consultUser($user, $password){
            $result_return = "";
            
            $this->querys = "SELECT * FROM user WHERE user_user='$user' AND password_user='$password';";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectDB->close();
            return $result_return;
        }
        public function updatePasswordUser($id, $newPassword){
            $result_return = "";
            $this->querys = "UPDATE user SET password_user='$newPassword' WHERE id_user='$id' ;";
            $result_return = array("successful-update",$newPassword); 
            if($this->connectDB->query($this->querys) === FALSE){
                $result_return = "not-successful"; 
            }

            $this->connectDB->close();
            return $result_return;
        }
        public function getReservations($id){
            $result_return = "";
            $this->querys = "SELECT id_reservation,type_event,date_reservation_start,
                price_total FROM reservations WHERE id_user='$id';";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = $this->result;
            $this->connectDB->close();
            return $result_return;
        }
        public function getDataRoom(){
            $result_return = "";

            $this->querys = "SELECT * FROM room;";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectDB->close();
            return $result_return;
        }
        public function getServices(){
            $result_return = "";

            $this->querys = "SELECT * FROM services ;";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = $this->result;

            $this->connectDB->close();
            return $result_return;
        }
        public function deleteReservation($id,$idUser){
            $result_return = "not-successful";
            $folio = $this->getFolioServices($id,$idUser);
            if($this->connectDB->query("DELETE FROM reservations WHERE id_reservation=$id".
            " AND id_user=$idUser;") === TRUE) {
                $this->connectDB->query("DELETE FROM folioServices WHERE id_folio_services=$folio;");
                $result_return = 'successful';
            }

            $this->connectDB->close();
            return $result_return;
        }
        public function getFolioServices($id,$idUser){
            $folio = "";
            $this->querys = $this->connectDB->query("SELECT * FROM reservations".
                " WHERE id_reservation=$id AND id_user=$idUser;");
            if($this->querys->num_rows){
                if($row = $this->querys->fetch_assoc()){
                    $this->deleteFolioServices($row['id_folio_services']);
                    $folio = $row['id_folio_services'];
                }
            }
            return $folio;
        }
        public function deleteFolioServices($folio){
            $this->connectDB->query("DELETE FROM selectedservices WHERE id_folio_services=$folio;");
        }
        public function pricebyHour(){
            $this->result = "";

            $this->querys = "SELECT price_hour FROM room WHERE id_saloon='1' ;";
            $this->result = $this->connectDB->query($this->querys);

            return $this->result;
        }
        public function getPriceServices($id){
            $this->result = "";

            $this->querys = "SELECT price FROM services WHERE id_service='$id';";
            $this->result = $this->connectDB->query($this->querys);

            return $this->result;
        }
        public function closeConnection(){
            $this->connectDB->close();
        }
        public function createFolioServices($total){
            $this->result = "";

            $this->querys = "INSERT INTO folioServices VALUES(null,$total);";
            if($this->connectDB->query($this->querys) === TRUE){
                $this->result = $this->connectDB->insert_id;
            }

            return $this->result; 
        }
        public function validateReservation($dateToReserve){
            $this->result = "";

            $this->querys= "select * from reservations where".
                " date_reservation_start>='$dateToReserve 00:00:00' and ".
                "date_reservation_start<='$dateToReserve 23:59:59';";
            $this->result = $this->connectDB->query($this->querys);
            
            return $this->result;
        }
        public function getServicesWithoutClosingBD(){
            $result_return = "";

            $this->querys = "SELECT * FROM services ;";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = $this->result;

            return $result_return;
        }
        public function addSelectedServices($id_service,$id_folio_services,$amount_service,
            $total_service){

            $this->querys = "INSERT INTO selectedservices VALUES($id_service, ".
                " $id_folio_services, $amount_service, $total_service);";
            $this->connectDB->query($this->querys);

        }
        public function addReservation($typeEvent,$priceTotal,$dateReservationStart,
            $dateReservationEnd,$idUser,$idFolioServices){
            $this->querys = "INSERT INTO reservations VALUES(null,'$typeEvent', ".
                "0, $priceTotal, '$dateReservationStart', '$dateReservationEnd', ".
                "$idUser,$idFolioServices,1);";
            $this->connectDB->query($this->querys);  
        }
        public function getInformationReservation($idReservation,$idUser){
            $this->querys = "SELECT * FROM reservations WHERE id_reservation=$idReservation".
                " AND id_user=$idUser;";
            $this->result = $this->connectDB->query($this->querys);

            $this->connectDB->close();
            
            return $this->result;
        }
        /**
         * This method adds a record for a user in the user table.
         */
        public function create_user($name_user, $pa_lastname_user, $mo_lastname_user,
            $email_user, $phone_user, $user_user, $password_user): array {
            if($this->user_exists($user_user)) {
                $query_status['status'] = false;
                $query_status['type'] = 'user_already_exists';
                $this->connectDB->close();
                return $query_status;
            }
            $this->querys = "INSERT INTO user VALUES(null,1,'$name_user','$pa_lastname_user','$mo_lastname_user','$email_user',".
                "'$phone_user','$user_user','$password_user')";

            $query_status = array('status'=>true);
            if($this->connectDB->query($this->querys) === FALSE) {
                $query_status['status'] = false;
                $query_status['type'] = 'error';
            } else {
                $query_status['id_user'] = $this->connectDB->insert_id;
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
        /**
         * This method returns the date reservations
         * for month indicated by $month in $year
         */
        public function select_date_reservations_for_month(string $year, string $month): string {
            $date_reservations = '{"value": false';
            $this->querys = "SELECT DAY(date_reservation_start) as day,status_reservation as status FROM reservations ".
                "WHERE YEAR(date_reservation_start)=$year AND MONTH(date_reservation_start)=$month";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $date_reservations = '{"value": true';
                while($row = $this->result->fetch_assoc()){
                    $date_reservations .= ',"'.$row['day'].'": [true,'.$row['status'].']';
                }
                $this->result->free();
            }
            $this->connectDB->close();
            $date_reservations .= '}';
            return $date_reservations;
        }
        /**
         * This method adds or update room
         */
        public function create_or_update_room($room, $schedule, $direction): string {
            $value_return = null;
            if($this->room_exists($room['id_saloon'])) {
                $value_return = $this->update_room($room, $schedule, $direction);
            } else {
                $value_return = $this->create_room($room, $schedule, $direction);
            }
            $this->connectDB->close();

            return $value_return;
        }
        /**
         * This method checks if the room indicated by $id_room
         * exists in the table room.
         * Warning: the method does not close the connection
         * to the database.
         */
        public function room_exists(int $id_rom): bool {
            if($this->connectDB->query("SELECT id_saloon FROM room WHERE id_saloon='$id_rom'")->num_rows > 0) {
                return true;
            }
            return false;
        }
        public function create_room($room, $schedule, $direction): string {
            $value_return = '{action: "create","status": false, "in_table": ';
            // Create direcction
            $this->querys = "INSERT INTO direction VALUES(null,'".$direction['street_direction']."','".
                $direction['state_direction']."','".$direction['municipality_direction']."','".
                $direction['suburb_direction']."')";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"direccion"}';
                return $value_return;
            }
            $direction['id_direction'] = $this->connectDB->insert_id;
            // Create schedule
            $this->querys = "INSERT INTO schedule VALUES(null,'".$schedule['sunday']."','".
                $schedule['monday']."','".$schedule['tuesday']."','".$schedule['wednesday']."','".
                $schedule['thursday']."','".$schedule['friday']."','".$schedule['saturday']."')";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"schedule"}';
                return $value_return;
            }
            $schedule['id_schedule'] = $this->connectDB->insert_id;
            // Create info_room
            $this->querys = "INSERT INTO info_room VALUES(null,".$direction['id_direction'].",".$schedule['id_schedule'].")";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"info_room"}';
                return $value_return;
            }
            $id_info_room = $this->connectDB->insert_id;
            // Create room
            $this->querys = "INSERT INTO room VALUES(null,'".$room['name_saloon']."',".$room['capacity_saloon'].",'".
                $room['description_saloon']."',$id_info_room)";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"room"}';
                return $value_return;
            }
            $room['id_saloon'] = $this->connectDB->insert_id;
            return '{"status": true, "action": "create", "t_direction":'.
                $direction['id_direction'].',"t_schedule":'.$schedule["id_schedule"].
                ',"t_room":'.$room['id_saloon'].',"t_info":'.$id_info_room.'}';
        }
        public function update_room($room, $schedule, $direction): string {
            $value_return = '{action: "update","status": false, "in_table": ';
            // Update direcction
            $this->querys = "UPDATE direction SET street_direction='".$direction['street_direction']."',state_direction='".
                $direction['state_direction']."',municipality_direction='".$direction['municipality_direction'].
                "',suburb_direction='".$direction['suburb_direction']."' WHERE id_direction=".$direction['id_direction'];
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"direccion"}';
                return $value_return;
            }
            // Update schedule
            $this->querys = "UPDATE schedule SET sunday='".$schedule['sunday']."',monday='".$schedule['monday']."',tuesday='".
                $schedule['tuesday']."',wednesday='".$schedule['wednesday']."',thursday='".$schedule['thursday'].
                "',friday='".$schedule['friday']."',saturday='".$schedule['saturday']."' WHERE id_schedule=".$schedule['id_schedule'];
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"schedule"}';
                return $value_return;
            }
            // Update room
            $this->querys = "UPDATE room SET name_saloon='".$room['name_saloon']."',capacity_saloon=".
                $room['capacity_saloon'].",description_saloon='".$room['description_saloon'].
                "' WHERE id_saloon=".$room['id_saloon'];
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"room"}';
                return false;
            }
            return '{"status": true, "action": "update"}';
        }
        /**
         * This method selects el room indicated by
         * $id_rom.
         * Warning: the method does not close the connection
         * to the database.
         */
        public function select_room_for_id(int $id_room) {
            $data_salon['t_direction'] = array('id_direction'=>0,'street_direction'=>'',
                'state_direction'=>'','municipality_direction'=>'','suburb_direction'=>'');
            $data_salon['t_schedule'] = array('id_schedule'=>0,'sunday'=>'N','monday'=>'N',
                'tuesday'=>'N', 'wednesday'=>'N', 'thursday'=>'N', 'friday'=>'N', 'saturday'=>'N');
            $data_salon['t_room'] = array('id_saloon'=>0, 'name_saloon'=>'','capacity_saloon'=>'',
                'description_saloon'=>'', 'id_info'=>0);
            $id_direction = 0;
            $id_schedule = 0;
            // Select room
            $this->querys = "SELECT * FROM room WHERE id_saloon=".$id_room;
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $data_salon['t_room'] = $this->result->fetch_assoc();
                $this->result->free();
            }
            // Select id for record direction and schedule
            $this->querys = "SELECT id_direction,id_schedule FROM info_room WHERE id_info=".$data_salon['t_room']['id_info'];
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $row = $this->result->fetch_assoc();
                $id_direction = $row['id_direction'];
                $id_schedule = $row['id_schedule'];
                $this->result->free();
            }
            // Select direction
            $this->querys = "SELECT * FROM direction WHERE id_direction=".$id_direction;
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $data_salon['t_direction'] = $this->result->fetch_assoc();
                $this->result->free();
            }
            // Select schedule
            $this->querys = "SELECT * FROM schedule WHERE id_schedule=".$id_schedule;
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $data_salon['t_schedule'] = $this->result->fetch_assoc();
                $this->result->free();
            }
            return json_encode($data_salon);
        }
        /**
         * This method selects the users that match
         * the MySQL pattern %$user%
         */
        public function select_user_for_user(string $user) {
            $value_return['value'] = false;
            $this->querys = "SELECT id_user,name_user,pa_lastname_user,mo_lastname_user,email_user,phone_user,user_user,password_user".
                " FROM user WHERE type_user=1 AND user_user LIKE '%$user%' LIMIT 15";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $value_return['value'] = true;
                while($row = $this->result->fetch_assoc()) {
                    $value_return['data_customers'][] = $row;
                }
                $this->result->free();
            }
            $this->connectDB->close();
            return json_encode($value_return);
        }
        /**
         * This method selects the firts 15 users type 1
         * of table user.
         */
        public function select_user_type1() {
            $value_return = [];
            $this->querys = "SELECT id_user,name_user,pa_lastname_user,mo_lastname_user,email_user,phone_user,user_user,password_user".
                " FROM user WHERE type_user=1 LIMIT 15";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            $this->connectDB->close();
            return json_encode($value_return);
        }
        public function update_user($data) {
            $value_return = '{"status": false}';
            $this->querys = "UPDATE user SET name_user='".$data['name_user']."',pa_lastname_user='".
                $data['pa_lastname_user']."',mo_lastname_user='".$data['mo_lastname_user']."',email_user='".
                $data['email_user']."',phone_user='".$data['phone_user']."',password_user='".$data['password_user'].
                "' WHERE id_user=".$data['id_user'];
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return = '{"status": true}';
            }
            $this->connectDB->close();
            return $value_return;
        }
        public function remove_user_type1($id_user) {
            $value_return = '{"status": false}';
            if($this->connectDB->query("DELETE FROM user WHERE type_user=1 AND id_user=$id_user") === TRUE) {
                $value_return = '{"status": true}';
            }
            return $value_return;
        }
        public function select_reservations_conf() {
            $value_return = [];
            $this->querys = "SELECT id_reservation,date_reservation_start,name_user,phone_user,".
                "email_user,name_saloon FROM reservations INNER JOIN(user,room) ON (user.id_user = reservations.id_user".
                " AND room.id_saloon = reservations.id_room) WHERE status_reservation=1";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            $this->connectDB->close();
            return $value_return;
        }
        public function select_reservations_unconf() {
            $value_return = [];
            $this->querys = "SELECT id_reservation,date_reservation_start,name_user,phone_user,".
                "email_user,name_saloon FROM reservations INNER JOIN(user,room) ON (user.id_user = reservations.id_user".
                " AND room.id_saloon = reservations.id_room) WHERE status_reservation=0";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            $this->connectDB->close();
            return $value_return;
        }
        public function confirm_reservation($id_reservation) {
            $value_return = '{"status": false}';
            $this->querys = "UPDATE reservations SET status_reservation=1 WHERE id_reservation=$id_reservation";
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return = '{"status": true}';
            }
            $this->connectDB->close();
            return $value_return;
        }
        /**
         * Warning: This method does not close conecction
         */
        public function get_total_reservations() {
            $this->querys = "SELECT id_reservation FROM reservations WHERE status_reservation=0";
            $this->result = $this->connectDB->query($this->querys);
            $value_return['unconfirmed'] = $this->result->num_rows;
            $this->result->free();
            $this->querys = "SELECT id_reservation FROM reservations WHERE status_reservation=1";
            $this->result = $this->connectDB->query($this->querys);
            $value_return['confirmed'] = $this->result->num_rows;
            $this->result->free();
            return json_encode($value_return);
        }
    }
?>