use mindk;
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `grp` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;



INSERT INTO `students` VALUES (1,'Vitalii','Korovai','M','itz-12c','1993-08-04'),
                              (2,'Olexandr','Kozolup','M','informatic','1994-03-01'),
                              (7,'Magdalena','Nedalaeva','F','itp-11c','1993-08-07'),
                              (9,'Zoya','Barigkina','F','itp-11c','1993-12-15'),
                              (10,'Maya','Aztekova','F','itp-101c','1993-04-11'),
                              (20,'Michael','Medvedev','M','110-i','1999-05-04');