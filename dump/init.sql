CREATE DATABASE IF NOT EXISTS tribe;
GRANT ALL ON tribe.* TO 'tribe'@'%';
FLUSH PRIVILEGES;

CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    first_name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    roles INT NOT NULL,
    UNIQUE INDEX UNIQ_USER_EMAIL (email),
    PRIMARY KEY(id));

CREATE TABLE actions (
   id INT AUTO_INCREMENT NOT NULL,
   name VARCHAR(255) NOT NULL,
   alias VARCHAR(255) NOT NULL,
   roles INT NOT NULL,
   UNIQUE INDEX UNIQ_ACTION_NAME (name),
   UNIQUE INDEX UNIQ_ACTION_ALIAS (alias),
   PRIMARY KEY(id));


INSERT INTO users (email, first_name, last_name, roles) VALUES ('admin@gmail.com', 'admin', 'last_name_admin', 1);
INSERT INTO users (email, first_name, last_name, roles) VALUES ('manager@gmail.com', 'manager', 'last_name_manager', 2);
INSERT INTO users (email, first_name, last_name, roles) VALUES ('user@gmail.com', 'user', 'last_name_user', 4);

insert INTO actions (name, alias, roles) VALUES ('User create', 'user_create', 1);
insert INTO actions (name, alias, roles) VALUES ('User edit', 'user_edit', 3);
insert INTO actions (name, alias, roles) VALUES ('User view', 'user_view', 7);