DROP TABLE IF EXISTS `itemcodes`;

CREATE TABLE `itemcodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL DEFAULT '',
  `name` varchar(256) NOT NULL DEFAULT '',
  `added_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(2) DEFAULT '1',
  `display` int(2) DEFAULT '1',
  `comment` varchar(256) DEFAULT NULL,
  `displayCopy` int(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_itemcode` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `itemcodes` (`id`, `code`, `name`, `added_datetime`, `enabled`, `display`, `comment`, `displayCopy`)
VALUES
	(1,'FOO','Foo things','2017-10-16 10:49:49',1,1,NULL,1),
	(2,'BAR','bar things','2017-10-16 10:49:49',1,1,NULL,1),
	(3,'DOE','Anything else','2017-10-16 10:49:49',1,1,NULL,-1);

UNLOCK TABLES;
