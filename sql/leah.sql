USE leah;

DROP TABLE emailcollectortbl;

CREATE TABLE `emailcollectortbl` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `interestlevel` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=big5;


INSERT INTO emailcollectortbl 
	(name,
	email,
	organization,
	comment,
	interestlevel)
	VALUES
	(
		'$name',
		'$emailaddress',
		'$organization',
		'$comment',
		$interest
	);


