CREATE DATABASE IF NOT EXISTS sallevent;
use sallevent;
CREATE TABLE IF NOT EXISTS direction(
    id_direction INT PRIMARY KEY AUTO_INCREMENT,
    street_direction VARCHAR(45) NOT NULL,
    state_direction VARCHAR(45) NOT NULL,
    municipality_direction VARCHAR(45) NOT NULL,
    suburb_direction VARCHAR(45)
);
CREATE TABLE IF NOT EXISTS schedule(
    id_schedule INT PRIMARY KEY AUTO_INCREMENT,
    sunday ENUM('N','Y') NOT NULL,
    monday ENUM('N','Y') NOT NULL,
    tuesday ENUM('N','Y') NOT NULL,
    wednesday ENUM('N','Y') NOT NULL,
    thursday ENUM('N','Y') NOT NULL,
    friday ENUM('N','Y') NOT NULL,
    saturday ENUM('N','Y') NOT NULL
);
CREATE TABLE IF NOT EXISTS info_room(
    id_info INT PRIMARY KEY AUTO_INCREMENT,
    id_direction INT NOT NULL NOT NULL,
    id_schedule INT NOT NULL NOT NULL,
    FOREIGN KEY (id_direction) REFERENCES direction(id_direction),
    FOREIGN KEY (id_schedule) REFERENCES schedule(id_schedule)
);
CREATE TABLE IF NOT EXISTS room(
    id_saloon INT PRIMARY KEY AUTO_INCREMENT,
    name_saloon VARCHAR(45) NOT NULL,
    capacity_saloon INT NOT NULL,
    description_saloon TEXT,
    id_info INT NOT NULL,
    FOREIGN KEY (id_info) REFERENCES info_room(id_info)
);
CREATE TABLE IF NOT EXISTS user(
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    type_user TINYINT NOT NULL,
    name_user VARCHAR(45) NOT NULL,
    pa_lastname_user VARCHAR(45) NOT NULL,
    mo_lastname_user VARCHAR(45) NOT NULL,
    email_user VARCHAR(45) NOT NULL,
    phone_user VARCHAR(11) NOT NULL,
    user_user VARCHAR(45) NOT NULL UNIQUE,
    password_user VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS services(
    id_service INT PRIMARY KEY AUTO_INCREMENT,
    name_service VARCHAR(45) NOT NULL,
    price FLOAT NOT NULL,
    detail VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS folioServices(
    id_folio_services INT PRIMARY KEY AUTO_INCREMENT,
    total_services FLOAT NOT NULL
);
CREATE TABLE IF NOT EXISTS selectedservices(
    id_service INT NOT NULL,
    id_folio_services INT NOT NULL,
    amount_service INT NOT NULL,
    total_service FLOAT NOT NULL,
    FOREIGN KEY (id_service) REFERENCES services(id_service),
    FOREIGN KEY (id_folio_services) REFERENCES folioServices(id_folio_services)
);
CREATE TABLE IF NOT EXISTS reservations(
    id_reservation INT PRIMARY KEY AUTO_INCREMENT,
    type_event VARCHAR(45) NOT NULL,
    num_asistants INT NOT NULL,
    status_reservation TINYINT NOT NULL,
    price_total FLOAT NOT NULL,
    date_reservation TIMESTAMP,
    id_user INT NOT NULL,
    id_folio_services INT NOT NULL,
    id_room INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_folio_services) REFERENCES folioServices(id_folio_services),
    FOREIGN KEY (id_room) REFERENCES room(id_saloon)
);
INSERT INTO user VALUES(null,0,"Mario","Perez","Ruiz","mario_123@hotmail.com","9581231234","admin","admin");
