CREATE DATABASE IF NOT EXISTS sallevent;
use sallevent;
CREATE TABLE IF NOT EXISTS user(
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    type_user TINYINT NOT NULL,
    name_user VARCHAR(45) NOT NULL,
    surname_user VARCHAR(45) NOT NULL,
    email_user VARCHAR(45) NOT NULL,
    phone_user VARCHAR(11) NOT NULL,
    user_user VARCHAR(45) NOT NULL,
    password_user VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS services(
    id_service INT PRIMARY KEY AUTO_INCREMENT,
    name_service VARCHAR(45) NOT NULL,
    price FLOAT NOT NULL,
    detail VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS date_reservation(
    id_date INT PRIMARY KEY AUTO_INCREMENT,
    date_reservation TIMESTAMP DEFAULT 
        CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS reservations(
    id_reservation INT PRIMARY KEY AUTO_INCREMENT,
    type_event VARCHAR(45) NOT NULL,
    num_asistants INT NOT NULL,
    status_reservation TINYINT NOT NULL,
    price_total FLOAT NOT NULL,
    id_user INT NOT NULL,
    id_service INT NOT NULL,
    id_date INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_service) REFERENCES services(id_service),
    FOREIGN KEY (id_date) REFERENCES date_reservation(id_date)
);
CREATE TABLE IF NOT EXISTS direction(
    id_direction INT PRIMARY KEY AUTO_INCREMENT,
    street_direction VARCHAR(45) NOT NULL,
    state_direction VARCHAR(45) NOT NULL,
    municipality_direction VARCHAR(45) NOT NULL,
    suburb_direction VARCHAR(45)
);
CREATE TABLE IF NOT EXISTS schedule(
    id_schedule INT PRIMARY KEY AUTO_INCREMENT,
    day_schedule VARCHAR(45) NOT NULL,
    status_schedule TINYINT NOT NULL 
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
    id_user INT NOT NULL,
    FOREIGN KEY (id_info) REFERENCES info_room(id_info),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);
