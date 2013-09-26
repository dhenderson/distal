DROP DATABASE IF EXISTS distal;
CREATE DATABASE distal;
USE distal;

CREATE TABLE advisory_groups(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	active BOOLEAN default true,
	PRIMARY KEY (id)
)ENGINE = MYISAM;

CREATE TABLE `users`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`password` varchar(255) NOT NULL DEFAULT '',
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	system_admin BOOLEAN default false,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	active BOOLEAN DEFAULT TRUE,
	email varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
)ENGINE = MYISAM;

CREATE TABLE user_advisory_groups(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	advisory_group_id INT NOT NULL,
	group_admin BOOLEAN DEFAULT FALSE,
	view_only BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id)
		REFERENCES users(id),
	FOREIGN KEY (advisory_group_id)
		REFERENCES advisory_groups(id)
)ENGINE = MYISAM;

CREATE TABLE organizations(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	description TEXT,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	active BOOLEAN DEFAULT TRUE,
	FULLTEXT (name, description),
	PRIMARY KEY (id)
)ENGINE = MYISAM;

CREATE TABLE organization_advisory_groups(
	id INT NOT NULL AUTO_INCREMENT,
	advisory_group_id INT NOT NULL,
	organization_id INT NOT NULL,
	can_edit BOOLEAN DEFAULT TRUE,
	PRIMARY KEY (id),
	FOREIGN KEY (advisory_group_id)
		REFERENCES advisory_groups(id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE programs(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	description TEXT,
	name varchar(255) NOT NULL,
	active BOOLEAN default true,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	FULLTEXT (name, description),
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE targets(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	description TEXT,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE program_targets(
	id INT NOT NULL AUTO_INCREMENT,
	target_id INT NOT NULL,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (target_id)
		REFERENCES targets(id),
	FOREIGN KEY (program_id)
		REFERENCES programs(id),
	UNIQUE INDEX (target_id, program_id)
)ENGINE = MYISAM;

CREATE TABLE outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	description TEXT,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE program_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	parent_outcome_id INT,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id),
	FOREIGN KEY (parent_outcome_id)
		REFERENCES outcomes(id),
	FOREIGN KEY (program_id)
		REFERENCES programs(id),
	UNIQUE INDEX (outcome_id, parent_outcome_id, program_id)
)ENGINE = MYISAM;

CREATE TABLE indicators(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	data_type_id INT NOT NULL,
	answer_option_type_id INT NOT NULL,
	description TEXT,
	answer_options TEXT,
	PRIMARY KEY (id),
	FOREIGN KEY (data_type_id)
		REFERENCES data_types(id),
	FOREIGN KEY (answer_option_type_id)
		REFERENCES answer_option_types(id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE indicator_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	indicator_id INT NOT NULL,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id),
	FOREIGN KEY (indicator_id)
		REFERENCES indicators(id),
	FOREIGN KEY (program_id)
		REFERENCES programs(id),
	UNIQUE INDEX (outcome_id, indicator_id, program_id)
)ENGINE = MYISAM;

CREATE TABLE data_types(
	id INT NOT NULL AUTO_INCREMENT,
	data_type varchar(10) NOT NULL,
	description varchar(100) NOT NULL,
	PRIMARY KEY (id)
)ENGINE = MYISAM;

CREATE TABLE answer_option_types(
	id INT NOT NULL AUTO_INCREMENT,
	answer_option_type varchar(20) NOT NULL,
	description varchar(100) NOT NULL,
	PRIMARY KEY (id)
)ENGINE = MYISAM;

CREATE TABLE interventions(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	description TEXT,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
)ENGINE = MYISAM;

CREATE TABLE intervention_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	intervention_id INT NOT NULL,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id),
	FOREIGN KEY (intervention_id)
		REFERENCES interventions(id),
	FOREIGN KEY (program_id)
		REFERENCES programs(id),
	UNIQUE INDEX (outcome_id, intervention_id, program_id)
)ENGINE = MYISAM;

/** DEFAULT SETTINGS **/

/** user defaults **/
INSERT INTO advisory_groups (name) VALUES("My advisory group");
INSERT INTO users (email, system_admin, password) VALUES("root", TRUE, '1234');
INSERT INTO user_advisory_groups (user_id, advisory_group_id) VALUES(1, 1);

/** data type defaults **/
INSERT INTO data_types (data_type, description) VALUES ('int', 'Integer');
INSERT INTO data_types (data_type, description) VALUES ('boolean', 'Boolean');
INSERT INTO data_types (data_type, description) VALUES ('float', 'Float');
INSERT INTO data_types (data_type, description) VALUES ('string', 'Text');
INSERT INTO data_types (data_type, description) VALUES ('date', 'Date');

/** answer option type defaults **/
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('choose_one', 'Choose one');
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('choose_many', 'Choose all that apply');
INSERT INTO answer_option_types (answer_option_type, description) VALUES ('fill_in', 'Fill in');