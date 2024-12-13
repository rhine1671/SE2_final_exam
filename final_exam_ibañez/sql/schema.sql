CREATE TABLE findhire_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
    	role ENUM('HR', 'Applicant') NOT NULL;
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE jobs (
	job_id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	city varchar(255) NOT NULL,
	company varchar(255) NOT NULL,
	category varchar(255) NOT NULL,
	job_type varchar(255) NOT NULL,
	experience_years varchar(255) NOT NULL,
	job_description longtext NOT NULL,
	qualification longtext NOT NULL,
	date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	added_by VARCHAR(255),
	last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	last_updated_by VARCHAR(255)
);

CREATE TABLE job_applications (
	job_app_id int(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	user_id INT NOT NULL,
	job_id INT NOT NULL,
	app_resume BLOB,
	letter TEXT, 
	application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 


CREATE TABLE messages (
	message_id	INT AUTO_INCREMENT PRIMARY KEY,
	user_id	INT,
	recipient_id INT,		
	content	TEXT,
	date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 

