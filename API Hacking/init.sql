CREATE USER 'apiMidcourseCapstone'@'localhost' IDENTIFIED BY 'iAmAWeakPassword';
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT on api_midcourse_capstone.* TO 'apiMidcourseCapstone'@'localhost';

CREATE TABLE coffee (id int NOT NULL, name varchar(255), origin varchar(255), roast_level varchar(20), PRIMARY KEY (id));
INSERT INTO coffee VALUES (0, "Revival", "Ethopia", "5");
INSERT INTO coffee VALUES (1, "Rise and shine", "Ethopia", "4");
INSERT INTO coffee VALUES (2, "Jitters", "Ethopia", "4");

CREATE TABLE orders (id int NOT NULL AUTO_INCREMENT, order_id varchar(20), email varchar(255), coffee_id int, quantity int, order_status varchar(20), PRIMARY KEY (id));
CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, username varchar(255), password varchar(255), user_status int, PRIMARY KEY (id));