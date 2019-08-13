-- Create emr Database
CREATE DATABASE support_db;
USE support_db;

-- Create Role Table
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(5) NOT NULL AUTO_INCREMENT,
  `role_description` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO role VALUES (1,'customer'),(2,'staff');
truncate users;
-- Create Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255),
  `role_id` int(5) not null,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (role_id) REFERENCES role (role_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO users VALUES (1,'Brian','John','brian.john@email.com',2),(2,'Jay','williams','jay.williams@email.com',1);
update users set password='1234';

-- Create Ticket Notes Table
CREATE TABLE IF NOT EXISTS `notes` (
  `notes_id` int(5) NOT NULL AUTO_INCREMENT,
  `notes` varchar(255) NOT NULL,
  `date` date not null,
  PRIMARY KEY (`notes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

drop table notes;

INSERT INTO notes 
VALUES	(1,'Issue with opening email','2019-08-01'),
		(2,'Still unable to open email','2019-08-02'),
        (3,'Need help opening a service ticket','2019-08-01');


drop table tickets;
-- Create Tickets Table
CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` int(5) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `user_id` int(5) not null,
  PRIMARY KEY (`ticket_id`),
  FOREIGN KEY (user_id) REFERENCES users (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE tickets
ADD FOREIGN KEY (user_id) REFERENCES users (id);

INSERT INTO tickets 
VALUES	(1,'Open',1),
		(2,'Open',2);

DROP TABLE ticket_notes;

CREATE TABLE IF NOT EXISTS `ticket_notes` (
  `ticket_id` int(5) NOT NULL,
  `notes_id` int(5) NOT NULL,
  UNIQUE KEY (ticket_id, notes_id),
  FOREIGN KEY (ticket_id) REFERENCES tickets (ticket_id),
  FOREIGN KEY (notes_id) REFERENCES notes (notes_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO ticket_notes
VALUES	(1,1),
		(2,1),
        (3,2);
