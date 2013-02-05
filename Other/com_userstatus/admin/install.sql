CREATE TABLE IF NOT EXISTS `#__sts_userstatus` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `status` int(1) NOT NULL default '0', 
  `location` int(11) NOT NULL,  
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL, 
  PRIMARY KEY  (`id`),
  KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `#__sts_locations` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL default '',
  `address` varchar(100) NOT NULL default '',
  `city` varchar(100) NOT NULL default '',
  `county` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL default '',
  `zip` varchar(25) NOT NULL default '',
  `notes` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  `published` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jos_ep_locations`
--

INSERT INTO `#__sts_locations` (`id`, `description`, `address`, `city`, `county`, `state`, `zip`, `notes`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 'Fire Station', '150 W 22nd Street', 'Cassville', 'Barry', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(2, 'County Court House', '5905 East Truman Road', 'Kahoka', 'Clark', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(3, 'City Hall', 'E 16th Terrace', 'Sedalia', 'Pettis', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(4, 'Police Station ', '150 W 22nd Street', 'Kirksville', 'Adair', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(5, 'Police Station', '5905 East Truman Road', 'Kansas City', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(6, 'County Services Warehouse', '150 W 22nd Street', 'Unionville', 'Putnam', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(7, 'Post Office', '5905 East Truman Road', 'Poplar Bluff', 'Butler', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(8, 'Fire Station # 12', '4242 Main Street', 'Kansas City', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(9, 'City Hall', '3220 Bellview', 'Pine Bluff', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0);
