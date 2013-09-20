DROP DATABASE IF EXISTS distal;
CREATE DATABASE distal;
USE distal;

CREATE TABLE user_groups(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	active BOOLEAN default true,
	PRIMARY KEY (id)
)ENGINE = MYISAM;
INSERT INTO user_groups (name) VALUES("My group");

CREATE TABLE `users`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`password` varchar(255) NOT NULL DEFAULT '',
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	system_admin BOOLEAN default false,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	active BOOLEAN default true,
	email varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
)ENGINE = MYISAM;
INSERT INTO users (email, system_admin, password) VALUES("root", TRUE, '1234');

CREATE TABLE user_user_groups(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	user_group_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id)
		REFERENCES users(id),
	FOREIGN KEY (user_group_id)
		REFERENCES user_groups(id)
)ENGINE = MYISAM;
INSERT INTO user_user_groups (user_id, user_group_id) VALUES(1, 1);

CREATE TABLE organizations(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	description TEXT,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	active BOOLEAN DEFAULT TRUE,
	user_group_id INT NOT NULL,
	FULLTEXT (name, description),
	PRIMARY KEY (id),
	FOREIGN KEY (user_group_id)
		REFERENCES user_groups(id)
)ENGINE = MYISAM;

CREATE TABLE projects(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	user_group_id INT,
	description TEXT,
	project_name varchar(255) NOT NULL,
	active BOOLEAN default true,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	FULLTEXT (project_name, description),
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE targets(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	description TEXT,
	project_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (project_id)
		REFERENCES projects(id)
)ENGINE = MYISAM;

CREATE TABLE outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	description TEXT,
	project_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (project_id)
		REFERENCES projects(id)
)ENGINE = MYISAM;

CREATE TABLE parent_child_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	parent_outcome_id INT NOT NULL,
	child_outcome_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (parent_outcome_id)
		REFERENCES outcome(id),
	FOREIGN KEY (child_outcome_id)
		REFERENCES outcome(id)
)ENGINE = MYISAM;

CREATE TABLE indicators(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	data_type_id INT NOT NULL,
	answer_option_type_id INT NOT NULL,
	description TEXT,
	answer_options TEXT,
	outcome_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (data_type_id)
		REFERENCES data_types(id),
	FOREIGN KEY (answer_option_type_id)
		REFERENCES answer_option_types(id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id)
)ENGINE = MYISAM;

CREATE TABLE data_types(
	id INT NOT NULL AUTO_INCREMENT,
	data_type varchar(10) NOT NULL,
	description varchar(100) NOT NULL,
	PRIMARY KEY (id)
)ENGINE = MYISAM;
INSERT INTO data_types (data_type, description) VALUES ('int', 'Integer');
INSERT INTO data_types (data_type, description) VALUES ('boolean', 'Boolean');
INSERT INTO data_types (data_type, description) VALUES ('float', 'Float');
INSERT INTO data_types (data_type, description) VALUES ('string', 'Text');
INSERT INTO data_types (data_type, description) VALUES ('date', 'Date');

CREATE TABLE answer_option_types(
	id INT NOT NULL AUTO_INCREMENT,
	answer_option_type varchar(20) NOT NULL,
	description varchar(100) NOT NULL,
	PRIMARY KEY (id)
)ENGINE = MYISAM;
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('choose_one', 'Choose one');
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('choose_many', 'Choose all that apply');
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('fill_in', 'Fill in');

CREATE TABLE interventions(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	description TEXT,
	outcome_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id)
)ENGINE = MYISAM;