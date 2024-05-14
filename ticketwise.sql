CREATE DATABASE ticketwise;

CREATE TABLE users (
    user_id BIGINT NOT NULL AUTO_INCREMENT,
    user_fname VARCHAR(255) NOT NULL,
    user_lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_role VARCHAR(255),
    phone_number VARCHAR(20),
    PRIMARY KEY (user_id)
);

CREATE TABLE events (
    event_id BIGINT NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(255) NOT NULL,
    event_datetime DATETIME NOT NULL,
    event_location VARCHAR(255),
    event_organizers VARCHAR(255),
    max_attendees INT NOT NULL,
    event_description TEXT,
    regular_ticket_no INT NOT NULL,
    vip_ticket_no INT NOT NULL,
    regular_ticket_price DECIMAL(10, 2) NOT NULL,
    vip_ticket_price DECIMAL(10, 2) NOT NULL,
    admin_id INT,
    PRIMARY KEY (event_id),
    FOREIGN KEY (admin_id) REFERENCES users(user_id)
);

CREATE TABLE tickets (
    ticket_id BIGINT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    ticket_type ENUM('regular', 'vip') NOT NULL,
    ticket_price DECIMAL(10, 2) NOT NULL,
    reservation_date DATETIME NOT NULL,
    PRIMARY KEY (ticket_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id)
);