

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `business_number` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `cell_number` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO clients VALUES ("1","Ben Enterprises","53163663","Banoji","Waghisn","5536446","6426426","companysite.com");
INSERT INTO clients VALUES ("2","make","353","faefe","geee","533","35553","fafa");
INSERT INTO clients VALUES ("4","fad","ga","fda","gah","w44","gda","gaeh.com");
INSERT INTO clients VALUES ("5","fa","faf","fa","fea","fe","fea","af");
INSERT INTO clients VALUES ("6","fa","faf","fa","fea","fe","fea","af");
INSERT INTO clients VALUES ("8","ribarshio","423515","john","doe","390509","431097","ribarshio.com");
INSERT INTO clients VALUES ("9","lsnf","89488","lfaioefb","ibiobfiueab","iofeiegho","fhohfe","fafbib@babe.com");



CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `start_date` date NOT NULL,
  `frequency` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `notification_id` (`notification_id`),
  CONSTRAINT `client_constraint` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_constraint` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO events VALUES ("1","1","1","2020-05-05","40");



CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'SMS',
  `status` varchar(100) NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO notifications VALUES ("1","Full Notify","SMS","enabled");



CREATE TABLE `users` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `picture` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users VALUES ("John","Doe","johndoe@gmail.com","308573296","Manager","john","527bd5b5d689e2c32ae974c6229ff785","active","1574909846.png");

