DROP TABLE IF EXISTS `#__team_race`;

CREATE TABLE `#__team_race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `speed` float NOT NULL,
  `raceid` int(11) NOT NULL,
  `tagid` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player` (`player`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
