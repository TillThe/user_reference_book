SET foreign_key_checks = 0;
DROP TABLE IF EXISTS education;
CREATE TABLE education
(
id int(5) NOT NULL PRIMARY KEY auto_increment,
name varchar(255) NOT NULL UNIQUE
);
DROP TABLE IF EXISTS city;
CREATE TABLE city
(
id int(5) NOT NULL PRIMARY KEY auto_increment,
name varchar(255) NOT NULL UNIQUE
);
DROP TABLE IF EXISTS user;
CREATE TABLE user
(
id int(5) NOT NULL PRIMARY KEY auto_increment,
name varchar(255) NOT NULL,
education_id int(5) NOT NULL,
FOREIGN KEY (education_id) REFERENCES education(id) ON DELETE CASCADE
);
DROP TABLE IF EXISTS users_city;
CREATE TABLE users_city
(
user_id int(5) NOT NULL,
city_id int(5) NOT NULL,
FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE CASCADE
);
SET foreign_key_checks = 1;
