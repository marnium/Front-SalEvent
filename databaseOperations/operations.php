<?php   
    class OperationBD{
        private $connectDB;
        private $querys;
        private $result;

        function __construct() {
            require_once('connect.php');
            $this->connectDB = ConectionDB::get_connection();
            $this->connectDB->set_charset('utf8');
        }
        
        /**
         * -----Validation for sql injection.------
         */
        public function consultUser($user, $password){
            $result_return = "";
            
            $user = $this->connectDB->real_escape_string($user);
            $password = $this->connectDB->real_escape_string($password);
            $this->querys = "SELECT * FROM user WHERE user_user='$user' AND password_user='$password';";
            $this->result = $this->connectDB->query($this->querys);
            $result_return = mysqli_fetch_array($this->result);
            
            $this->connectDB->close();
            return $result_return;
        }
        public function updatePasswordUser($id, $newPassword){
            $id = $this->connectDB->real_escape_string($id);
            $newPassword = $this->connectDB->real_escape_string($newPassword);

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
            $id = $this->connectDB->real_escape_string($id);

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
            $id = $this->connectDB->real_escape_string($id);
            $idUser = $this->connectDB->real_escape_string($idUser);

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
            $id = $this->connectDB->real_escape_string($id);
            $idUser = $this->connectDB->real_escape_string($idUser);

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
            $folio = $this->connectDB->real_escape_string($folio);

            $this->connectDB->query("DELETE FROM selectedservices WHERE id_folio_services=$folio;");
        }
        public function pricebyHour(){
            $this->result = "";

            $this->querys = "SELECT price_hour FROM room WHERE id_saloon='1' ;";
            $this->result = $this->connectDB->query($this->querys);

            return $this->result;
        }
        public function getPriceServices($id){
            $id = $this->connectDB->real_escape_string($id);

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
            $dateToReserve = $this->connectDB->real_escape_string($dateToReserve);

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
            $id_service = $this->connectDB->real_escape_string($id_service);
            $id_folio_services = $this->connectDB->real_escape_string($id_folio_services);
            $amount_service = $this->connectDB->real_escape_string($amount_service);
            $total_service = $this->connectDB->real_escape_string($total_service);

            $this->querys = "INSERT INTO selectedservices VALUES($id_service, ".
                " $id_folio_services, $amount_service, $total_service);";
            $this->connectDB->query($this->querys);

        }
        public function addReservation($typeEvent,$priceTotal,$dateReservationStart,
            $dateReservationEnd,$idUser,$idFolioServices){
            $typeEvent = $this->connectDB->real_escape_string($typeEvent);
            $priceTotal = $this->connectDB->real_escape_string($priceTotal);
            $dateReservationStart = $this->connectDB->real_escape_string($dateReservationStart);
            $dateReservationEnd = $this->connectDB->real_escape_string($dateReservationEnd);
            $idUser = $this->connectDB->real_escape_string($idUser);
            $idFolioServices = $this->connectDB->real_escape_string($idFolioServices);

            $this->querys = "INSERT INTO reservations VALUES(null,'$typeEvent', ".
                "0, $priceTotal, '$dateReservationStart', '$dateReservationEnd', ".
                "$idUser,$idFolioServices,1);";
            $this->connectDB->query($this->querys);

        }
        public function getInformationReservation($idReservation,$idUser){
            $idReservation = $this->connectDB->real_escape_string($idReservation);
            $idUser = $this->connectDB->real_escape_string($idUser);

            $this->querys = "SELECT * FROM reservations WHERE id_reservation=$idReservation".
                " AND id_user=$idUser;";
            $this->result = $this->connectDB->query($this->querys);

            $this->connectDB->close();
            
            return $this->result;
        }
        public function getValueService($idService,$folioService){
            $idService = $this->connectDB->real_escape_string($idService);
            $folioService = $this->connectDB->real_escape_string($folioService);

            $this->querys = "SELECT amount_service".
                " FROM selectedservices WHERE id_folio_services=$folioService AND ".
                "id_service=$idService;";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows){
                if($row = $this->result->fetch_assoc()){
                    $this->result = $row['amount_service'];
                }
            }else{
                $this->result = "";
            }
            
            return $this->result;
        }
        public function updateFolioServices($folio,$newTotal){
            $folio = $this->connectDB->real_escape_string($folio);
            $newTotal = $this->connectDB->real_escape_string($newTotal);

            $this->querys = "UPDATE folioServices SET total_services=$newTotal ".
                "WHERE id_folio_services=$folio ;";
            $this->connectDB->query($this->querys);
        }
        public function updateReservations($typeEvent,$priceTotal,$dateStart,$dateEnd,$id){
            $typeEvent = $this->connectDB->real_escape_string($typeEvent);
            $priceTotal = $this->connectDB->real_escape_string($priceTotal);
            $dateStart = $this->connectDB->real_escape_string($dateStart);
            $dateEnd = $this->connectDB->real_escape_string($dateEnd);
            $id = $this->connectDB->real_escape_string($id);

            $this->querys = "UPDATE reservations SET type_event='$typeEvent', ".
                "price_total=$priceTotal, date_reservation_start='$dateStart', ".
                "date_reservation_end='$dateEnd' WHERE id_reservation=$id ;";
            $this->connectDB->query($this->querys);
        }
        public function sendMessageContac($fullName,$email,$phone,$message){

            $fullName = $this->connectDB->real_escape_string($fullName);
            $email = $this->connectDB->real_escape_string($email);
            $phone = $this->connectDB->real_escape_string($phone);
            $message = $this->connectDB->real_escape_string($message);

            $this->querys = "INSERT INTO contac VALUES(null, '$fullName', ".
                "'$email', '$phone', '$message')";
            $this->connectDB->query($this->querys);

            $this->connectDB->close();
        }
        public function businessDays(){
            $dataReturn = "";

            $this->querys = "SELECT * FROM schedule WHERE id_schedule=1";
            $dataReturn = $this->connectDB->query($this->querys);

            $this->connectDB->close();

            return $dataReturn;
        }
        /**
         * This method adds a record for a user in the user table.
         * -----Validation for sql injection.-----
         */
        public function create_user($name_user, $pa_lastname_user, $mo_lastname_user,
            $email_user, $phone_user, $user_user, $password_user): array {
            $user_user = $this->connectDB->real_escape_string($user_user);
            if($this->user_exists($user_user)) {
                $query_status['status'] = false;
                $query_status['type'] = 'user_already_exists';
                $this->connectDB->close();
                return $query_status;
            }
            $name_user = $this->connectDB->real_escape_string($name_user);
            $pa_lastname_user = $this->connectDB->real_escape_string($pa_lastname_user);
            $mo_lastname_user = $this->connectDB->real_escape_string($mo_lastname_user);
            $email_user = $this->connectDB->real_escape_string($email_user);
            $phone_user = $this->connectDB->real_escape_string($phone_user);
            $password_user = $this->connectDB->real_escape_string($password_user);
            $this->querys = "INSERT INTO user VALUES(null,1,'$name_user','$pa_lastname_user','$mo_lastname_user','$email_user',".
                "'$phone_user','$user_user','$password_user')";

            $query_status = array('status'=>true);
            if($this->connectDB->query($this->querys) === FALSE) {
                $query_status['status'] = false;
                $query_status['type'] = 'error';
            } else {
                $query_status['id_user'] = $this->connectDB->insert_id;
            }
            return $query_status;
        }
        /**
         * This method checks if the user indicated by $user
         * exists in the user table.
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
         * -----Validation for sql injection.------
         */
        public function select_date_reservations_for_month(string $year, string $month): string {
            $year = $this->connectDB->real_escape_string($year);
            $month = $this->connectDB->real_escape_string($month);
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
         * -----Validation for sql injection.------
         */
        public function create_or_update_room($room, $schedule, $direction): string {
            $value_return = null;
            if($this->room_exists($room['id_saloon'])) {
                $value_return = $this->update_room($room, $schedule, $direction);
            } else {
                $value_return = $this->create_room($room, $schedule, $direction);
            }
            return $value_return;
        }
        /**
         * This method checks if the room indicated by $id_room
         * exists in the table room.
         * -----Validation for sql injection.------
         */
        public function room_exists(string $id_room): bool {
            $id_room = $this->connectDB->real_escape_string($id_room);
            if($this->connectDB->query("SELECT id_saloon FROM room WHERE id_saloon='$id_room'")->num_rows > 0) {
                return true;
            }
            return false;
        }
        /**
         * -----Validation for sql injection.------
         */
        public function create_room($room, $schedule, $direction): string {
            $value_return = '{action: "create","status": false, "in_table": ';
            // Create direcction
            $direction['street_direction'] = $this->connectDB->real_escape_string($direction['street_direction']);
            $direction['state_direction'] = $this->connectDB->real_escape_string($direction['state_direction']);
            $direction['municipality_direction'] = $this->connectDB->real_escape_string($direction['municipality_direction']);
            $direction['suburb_direction'] = $this->connectDB->real_escape_string($direction['suburb_direction']);
            $this->querys = "INSERT INTO direction VALUES(null,'".$direction['street_direction']."','".
                $direction['state_direction']."','".$direction['municipality_direction']."','".
                $direction['suburb_direction']."')";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"direccion"}';
                return $value_return;
            }
            $direction['id_direction'] = $this->connectDB->insert_id;
            // Create schedule
            $schedule['sunday'] = $this->connectDB->real_escape_string($schedule['sunday']);
            $schedule['monday'] = $this->connectDB->real_escape_string($schedule['monday']);
            $schedule['tuesday'] = $this->connectDB->real_escape_string($schedule['tuesday']);
            $schedule['wednesday'] = $this->connectDB->real_escape_string($schedule['wednesday']);
            $schedule['thursday'] = $this->connectDB->real_escape_string($schedule['thursday']);
            $schedule['friday'] = $this->connectDB->real_escape_string($schedule['friday']);
            $schedule['saturday'] = $this->connectDB->real_escape_string($schedule['saturday']);
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
            $room['name_saloon'] = $this->connectDB->real_escape_string($room['name_saloon']);
            $room['capacity_saloon'] = $this->connectDB->real_escape_string($room['capacity_saloon']);
            $room['description_saloon'] = $this->connectDB->real_escape_string($room['description_saloon']);
            $room['price_hour'] = $this->connectDB->real_escape_string($room['price_hour']);
            $this->querys = "INSERT INTO room VALUES(null,'".$room['name_saloon']."',".$room['capacity_saloon'].",'".
                $room['description_saloon']."',".$room['price_hour'].",$id_info_room)";
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"room"}';
                return $value_return;
            }
            $room['id_saloon'] = $this->connectDB->insert_id;
            return '{"status": true, "action": "create", "t_direction":'.
                $direction['id_direction'].',"t_schedule":'.$schedule["id_schedule"].
                ',"t_room":'.$room['id_saloon'].',"t_info":'.$id_info_room.'}';
        }
        /**
         * -----Validation for sql injection.------
         */
        public function update_room($room, $schedule, $direction): string {
            $value_return = '{action: "update","status": false, "in_table": ';
            // Update direcction
            $direction['street_direction'] = $this->connectDB->real_escape_string($direction['street_direction']);
            $direction['state_direction'] = $this->connectDB->real_escape_string($direction['state_direction']);
            $direction['municipality_direction'] = $this->connectDB->real_escape_string($direction['municipality_direction']);
            $direction['suburb_direction'] = $this->connectDB->real_escape_string($direction['suburb_direction']);
            $direction['id_direction'] = $this->connectDB->real_escape_string($direction['id_direction']);
            $this->querys = "UPDATE direction SET street_direction='".$direction['street_direction']."',state_direction='".
                $direction['state_direction']."',municipality_direction='".$direction['municipality_direction'].
                "',suburb_direction='".$direction['suburb_direction']."' WHERE id_direction=".$direction['id_direction'];
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"direccion"}';
                return $value_return;
            }
            // Update schedule
            $schedule['sunday'] = $this->connectDB->real_escape_string($schedule['sunday']);
            $schedule['monday'] = $this->connectDB->real_escape_string($schedule['monday']);
            $schedule['tuesday'] = $this->connectDB->real_escape_string($schedule['tuesday']);
            $schedule['wednesday'] = $this->connectDB->real_escape_string($schedule['wednesday']);
            $schedule['thursday'] = $this->connectDB->real_escape_string($schedule['thursday']);
            $schedule['friday'] = $this->connectDB->real_escape_string($schedule['friday']);
            $schedule['saturday'] = $this->connectDB->real_escape_string($schedule['saturday']);
            $schedule['id_schedule'] = $this->connectDB->real_escape_string($schedule['id_schedule']);
            $this->querys = "UPDATE schedule SET sunday='".$schedule['sunday']."',monday='".$schedule['monday']."',tuesday='".
                $schedule['tuesday']."',wednesday='".$schedule['wednesday']."',thursday='".$schedule['thursday'].
                "',friday='".$schedule['friday']."',saturday='".$schedule['saturday']."' WHERE id_schedule=".$schedule['id_schedule'];
            if($this->connectDB->query($this->querys) === FALSE) {
                $value_return .= '"schedule"}';
                return $value_return;
            }
            // Update room
            $room['name_saloon'] = $this->connectDB->real_escape_string($room['name_saloon']);
            $room['capacity_saloon'] = $this->connectDB->real_escape_string($room['capacity_saloon']);
            $room['price_hour'] = $this->connectDB->real_escape_string($room['price_hour']);
            $room['description_saloon'] = $this->connectDB->real_escape_string($room['description_saloon']);
            $room['id_saloon'] = $this->connectDB->real_escape_string($room['id_saloon']);
            $this->querys = "UPDATE room SET name_saloon='".$room['name_saloon']."',capacity_saloon=".
                $room['capacity_saloon'].",price_hour=".$room['price_hour'].
                ",description_saloon='".$room['description_saloon'].
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
         */
        public function select_room_for_id(int $id_room) {
            $data_salon['t_direction'] = array('id_direction'=>0,'street_direction'=>'',
                'state_direction'=>'','municipality_direction'=>'','suburb_direction'=>'');
            $data_salon['t_schedule'] = array('id_schedule'=>0,'sunday'=>'N','monday'=>'N',
                'tuesday'=>'N', 'wednesday'=>'N', 'thursday'=>'N', 'friday'=>'N', 'saturday'=>'N');
            $data_salon['t_room'] = array('id_saloon'=>0, 'name_saloon'=>'','capacity_saloon'=>'',
                'price_hour'=>0,'description_saloon'=>'', 'id_info'=>0);
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
         * -----Validation for sql injection.------
         */
        public function select_user_for_user(string $user) {
            $value_return['value'] = false;
            $user = $this->connectDB->real_escape_string($user);
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
            return json_encode($value_return);
        }
        /**
         * This method update user (client and admin) in table user.
         * -----Validation for sql injection.------
         */
        public function update_user($data) {
            $value_return = '{"status": false}';
            $data['name_user'] = $this->connectDB->real_escape_string($data['name_user']);
            $data['pa_lastname_user'] = $this->connectDB->real_escape_string($data['pa_lastname_user']);
            $data['mo_lastname_user'] = $this->connectDB->real_escape_string($data['mo_lastname_user']);
            $data['email_user'] = $this->connectDB->real_escape_string($data['email_user']);
            $data['phone_user'] = $this->connectDB->real_escape_string($data['phone_user']);
            $data['password_user'] = $this->connectDB->real_escape_string($data['password_user']);
            $data['id_user'] = $this->connectDB->real_escape_string($data['id_user']);
            $this->querys = "UPDATE user SET name_user='".$data['name_user']."',pa_lastname_user='".
                $data['pa_lastname_user']."',mo_lastname_user='".$data['mo_lastname_user']."',email_user='".
                $data['email_user']."',phone_user='".$data['phone_user']."',password_user='".$data['password_user'].
                "' WHERE id_user=".$data['id_user'];
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return = '{"status": true}';
            }
            return $value_return;
        }
        /**
         * This method delete user (only client) in table user.
         * -----Validation for sql injection.------
         */
        public function remove_user_type1($id_user) {
            $value_return = '{"status": false, "type": "faillure"}';
            $id_user = $this->connectDB->real_escape_string($id_user);
            //If exists reservations
            $this->querys = "SELECT id_reservations FROM reservations WHERE id_user=$id_user AND NOW()<date_reservation_end";
            if($this->connectDB->query($this->querys)->num_rows > 0) {
                $value_return = '{"status": false, "type": "exists_reservations"';
            }
            if($this->connectDB->query("DELETE FROM user WHERE type_user=1 AND id_user=$id_user") === TRUE) {
                $value_return = '{"status": true}';
            }
            return $value_return;
        }
        /**
         * This method select the reservations in status confirmed.
         */
        public function select_reservations_conf() {
            $value_return = [];
            $this->querys = "SELECT id_reservation,date_reservation_start,name_user,user_user,pa_lastname_user,".
                "mo_lastname_user,phone_user,email_user,name_saloon FROM reservations INNER JOIN(user,room) ON (user.id_user = reservations.id_user".
                " AND room.id_saloon = reservations.id_room) WHERE status_reservation=1";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            return $value_return;
        }
        /**
         * This methos select the reservations in status unconfirmed.
         */
        public function select_reservations_unconf() {
            $value_return = [];
            $this->querys = "SELECT id_reservation,date_reservation_start,name_user,pa_lastname_user,user_user,".
                "mo_lastname_user,phone_user,email_user,name_saloon FROM reservations INNER JOIN(user,room) ON (user.id_user = reservations.id_user".
                " AND room.id_saloon = reservations.id_room) WHERE status_reservation=0";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            return $value_return;
        }
        /**
         * This method update status reservation to confirmed.
         * -----Validation for sql injection.------
         */
        public function confirm_reservation($id_reservation) {
            $value_return = '{"status": false}';
            $id_reservation = $this->connectDB->real_escape_string($id_reservation);
            $this->querys = "UPDATE reservations SET status_reservation=1 WHERE id_reservation=$id_reservation";
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return = '{"status": true}';
            }
            return $value_return;
        }
        /**
         * This method return total reservations {'confirmed', 'unconfirmed'}.
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
        public function select_services() {
            $value_return = [];
            $this->querys = "SELECT * FROM services LIMIT 15";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                while($row = $this->result->fetch_assoc()) {
                    $value_return[] = $row;
                }
                $this->result->free();
            }
            return json_encode($value_return);
        }
        /**
         * This method select services for name
         * -----Validation for sql injection.------
         */
        public function select_services_for_name(string $name_service) {
            $value_return['value'] = false;
            $name_service = $this->connectDB->real_escape_string($name_service);
            $this->querys = "SELECT * FROM services WHERE name_service LIKE '%$name_service%' LIMIT 15";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $value_return['value'] = true;
                while($row = $this->result->fetch_assoc()) {
                    $value_return['data_services'][] = $row;
                }
                $this->result->free();
            }
            return json_encode($value_return);
        }
        /**
         * This method create a service; only for admin
         * -----Validation for sql injection.------
         */
        public function create_service($data) {
            $value_return['status'] = false;
            $data['name_service'] = $this->connectDB->real_escape_string($data['name_service']);
            $data['price'] = $this->connectDB->real_escape_string($data['price']);
            $data['detail'] = $this->connectDB->real_escape_string($data['detail']);
            $this->querys = "INSERT INTO services VALUES(null,'".$data['name_service']."',".
                $data['price'].",'".$data['detail']."')";
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return['status'] = true;
                $value_return['id_service'] = $this->connectDB->insert_id;
            }
            return json_encode($value_return);
        }
        /**
         * This method update a service; only for admin
         * -----Validation for sql injection.------
         */
        public function update_service($data) {
            $value_return = '{"status": false}';
            $data['name_service'] = $this->connectDB->real_escape_string($data['name_service']);
            $data['price'] = $this->connectDB->real_escape_string($data['price']);
            $data['detail'] = $this->connectDB->real_escape_string($data['detail']);
            $data['id_service'] = $this->connectDB->real_escape_string($data['id_service']);
            $this->querys = "UPDATE services SET name_service='".$data['name_service']."',price=".
                $data['price'].",detail='".$data['detail']."' WHERE id_service=".$data['id_service'];
            if($this->connectDB->query($this->querys) === TRUE) {
                $value_return = '{"status": true}';
            }
            return $value_return;
        }
        public function select_data_admin(int $id_user) {
            $value_return = array('id_user'=>1, 'name_user'=>'', 'pa_lastname_user'=>'', 'mo_lastname_user'=>'',
                'email_user'=>'','phone_user'=>'','user_user'=>'admin','password_user'=>'');
            $this->querys = "SELECT id_user,name_user,pa_lastname_user,mo_lastname_user,email_user,phone_user,user_user,password_user".
                " FROM user WHERE type_user=0 AND id_user=$id_user";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $value_return = $this->result->fetch_assoc();
                $this->result->free();
            }
            return json_encode($value_return);
        }
        public function select_data_footer() {
            $value_return['direction']['street_direction'] = '';
            $value_return['direction']['suburb_direction'] = '';
            $value_return['direction']['municipality_direction'] = '';
            $value_return['contact']['email_user'] = '';
            $value_return['contact']['phone_user'] = '';
            $this->querys = "SELECT street_direction,suburb_direction,municipality_direction FROM direction WHERE id_direction=1";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $value_return['direction'] = $this->result->fetch_assoc();
                $this->result->free();
            }
            $this->querys = "SELECT email_user,phone_user FROM user WHERE id_user=1";
            $this->result = $this->connectDB->query($this->querys);
            if($this->result->num_rows > 0) {
                $value_return['contact'] = $this->result->fetch_assoc();
                $this->result->free();
            }
            return $value_return;
        }
    }
?>