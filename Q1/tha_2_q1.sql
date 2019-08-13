-- Create emr Database
CREATE DATABASE book_db;
USE book_db;

-- Locate mysql and run in Terminal: mysql -u root -ptwEe7TJd --local-infile=1 book_db
SHOW VARIABLES LIKE 'local_infile';
SET GLOBAL local_infile = 1;

DROP TABLE book;

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  PRIMARY KEY (`book_id`),
  FOREIGN KEY (publisher_name) REFERENCES publisher (name)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/book.csv' INTO TABLE book COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

insert into book_db.book values (1,'Titanic','Publisher 1');
insert into book_db.book values (2,'Four Men and a Prayer','Publisher 2');
insert into book_db.book values (3,'Villa Rides!','Publisher 3');
insert into book_db.book values (4,'Star Wars: Episode V - The Empire Strikes Back','Publisher 4');
insert into book_db.book values (5,'The Great Gatsby','Publisher 5');

DROP TABLE book_authors;

CREATE TABLE IF NOT EXISTS `book_authors` (
  `book_id` int(5) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  PRIMARY KEY (`book_id`, `author_name`),
  FOREIGN KEY (book_id) REFERENCES book (book_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/book_authors.csv' INTO TABLE book_authors COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

DROP TABLE publisher;

CREATE TABLE IF NOT EXISTS `publisher` (
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE book
ADD FOREIGN KEY (publisher_name) REFERENCES publisher (name);

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/publisher.csv' INTO TABLE publisher COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

drop table library_branch;

CREATE TABLE IF NOT EXISTS `library_branch` (
  `branch_id` INT(5) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/library_branch.csv' INTO TABLE library_branch COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

drop table borrower;

CREATE TABLE IF NOT EXISTS `borrower` (
  `card_no` INT(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`card_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/borrower.csv' INTO TABLE borrower COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

CREATE TABLE IF NOT EXISTS `book_copies` (
  `book_id` INT(5) NOT NULL,
  `branch_id` INT(5) NOT NULL,
  `no_of_copies` INT(5) NOT NULL,
  PRIMARY KEY (`book_id`,`branch_id`),
  FOREIGN KEY (book_id) REFERENCES book (book_id),
  FOREIGN KEY (branch_id) REFERENCES library_branch (branch_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_dis
Developer_Course/FS1030/Take Home Assignment 2/book_copies.csv' INTO TABLE book_copies COLUMNS TERMINATED BY ',' IGNORE 1 LINES;

drop table book_loans;

CREATE TABLE IF NOT EXISTS `book_loans` (
  `book_id` INT(5) NOT NULL,
  `branch_id` INT(5) NOT NULL,
  `card_no` INT(15) NOT NULL,
  `date_out` date not null,
  `due_date` date not null,
  PRIMARY KEY (`book_id`,`branch_id`,`card_no`),
  FOREIGN KEY (book_id) REFERENCES book (book_id),
  FOREIGN KEY (branch_id) REFERENCES library_branch (branch_id),
  FOREIGN KEY (card_no) REFERENCES borrower (card_no)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

LOAD DATA LOCAL INFILE '/Users/nealmiran/Documents/Full_Stack_Developer_Course/FS1030/Take Home Assignment 2/book_loans.csv' INTO TABLE book_loans COLUMNS TERMINATED BY ',' IGNORE 1 LINES;