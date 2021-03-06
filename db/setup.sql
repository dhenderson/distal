DROP DATABASE IF EXISTS distal;
CREATE DATABASE distal;
USE distal;

CREATE TABLE `users`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`password` varchar(255) NOT NULL DEFAULT '',
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	system_admin BOOLEAN default false,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	active BOOLEAN default TRUE,
	email varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE organizations(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	is_active BOOLEAN DEFAULT TRUE,
	deactivation_date datetime,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE programs(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
);

CREATE TABLE program_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	parent_outcome_id INT,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (parent_outcome_id)
		REFERENCES outcomes(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (program_id)
		REFERENCES programs(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	UNIQUE INDEX (outcome_id, parent_outcome_id, program_id)
);

CREATE TABLE data_types(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(100) NOT NULL,
	data_type varchar(10) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE answer_option_types(
	id INT NOT NULL AUTO_INCREMENT,
	answer_option_type varchar(20) NOT NULL,
	name varchar(100) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE indicators(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	data_type_id INT NOT NULL,
	answer_option_type_id INT NOT NULL,
	answer_options TEXT,
	PRIMARY KEY (id),
	FOREIGN KEY (data_type_id)
		REFERENCES data_types(id),
	FOREIGN KEY (answer_option_type_id)
		REFERENCES answer_option_types(id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE indicator_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	indicator_id INT NOT NULL,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (indicator_id)
		REFERENCES indicators(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (program_id)
		REFERENCES programs(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	UNIQUE INDEX (outcome_id, indicator_id, program_id)
);

CREATE TABLE interventions(
	id INT NOT NULL AUTO_INCREMENT,
	organization_id INT NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (organization_id)
		REFERENCES organizations(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE intervention_outcomes(
	id INT NOT NULL AUTO_INCREMENT,
	outcome_id INT NOT NULL,
	intervention_id INT NOT NULL,
	program_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (outcome_id)
		REFERENCES outcomes(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (intervention_id)
		REFERENCES interventions(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY (program_id)
		REFERENCES programs(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	UNIQUE INDEX (outcome_id, intervention_id, program_id)
);

/** DEFAULT SETTINGS **/

/** data type defaults **/
INSERT INTO data_types (data_type, name) VALUES ('int', 'Integer');
INSERT INTO data_types (data_type, name) VALUES ('boolean', 'Boolean');
INSERT INTO data_types (data_type, name) VALUES ('float', 'Float');
INSERT INTO data_types (data_type, name) VALUES ('string', 'Text');
INSERT INTO data_types (data_type, name) VALUES ('date', 'Date');

/** answer option type defaults **/
INSERT INTO answer_option_types (answer_option_type, name) VALUES ('choose_one', 'Choose one');
INSERT INTO answer_option_types (answer_option_type, name) VALUES ('choose_many', 'Choose all that apply');
INSERT INTO answer_option_types (answer_option_type, name) VALUES ('fill_in', 'Fill in');