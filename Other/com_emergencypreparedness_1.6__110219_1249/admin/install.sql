CREATE TABLE IF NOT EXISTS  `#__ep_inventory` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL default '',
  `asset_type` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `lastlocation` varchar(100) NOT NULL default '',
  `athome` varchar(100) NOT NULL default 'Y',
  `dateinservice` datetime NOT NULL default '0000-00-00 00:00:00', 
  `datecheckedout` datetime NOT NULL default '0000-00-00 00:00:00',
  `dateexpectedback` datetime NOT NULL default '0000-00-00 00:00:00',
  `notes` text NOT NULL,
  `checked_out` INTEGER UNSIGNED NOT NULL default '0',
  `checked_out_time` DATETIME  NOT NULL,
  `published` INTEGER UNSIGNED NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE IF NOT EXISTS  `#__ep_asset_type` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL,
  `notes` text NOT NULL,
  `checked_out` INTEGER UNSIGNED NOT NULL default '0',
  `checked_out_time` DATETIME   NOT NULL,
  `published` INTEGER UNSIGNED NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE IF NOT EXISTS  `#__ep_keyword` (
  `id` int(11) NOT NULL auto_increment,
  `asset_type`  int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `typeofdata` varchar(1) NOT NULL,
  `notes` text NOT NULL,
  `checked_out` INTEGER UNSIGNED NOT NULL default '0',
  `checked_out_time` DATETIME   NOT NULL,
  `published` INTEGER UNSIGNED NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE IF NOT EXISTS  `#__ep_specifications` (
  `id` int(11) NOT NULL auto_increment,
  `inventory_id` int(11) NOT NULL,
  `asset_type` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `checked_out` INTEGER UNSIGNED NOT NULL default '0',
  `checked_out_time` DATETIME  NOT NULL,
  `published` INTEGER UNSIGNED NOT NULL default '0',
  PRIMARY KEY  (`id`)
); 
CREATE TABLE IF NOT EXISTS `#__ep_locations` (
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

INSERT INTO `#__ep_locations` (`id`, `description`, `address`, `city`, `county`, `state`, `zip`, `notes`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 'Fire Station', '150 W 22nd Street', 'Cassville', 'Barry', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(2, 'County Court House', '5905 East Truman Road', 'Kahoka', 'Clark', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(3, 'City Hall', 'E 16th Terrace', 'Sedalia', 'Pettis', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(4, 'Police Station ', '150 W 22nd Street', 'Kirksville', 'Adair', 'Mo', '64126', '', 0, '0000-00-00 00:00:00', 0),
(5, 'Police Station', '5905 East Truman Road', 'Kansas City', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(6, 'County Services Warehouse', '150 W 22nd Street', 'Unionville', 'Putnam', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(7, 'Post Office', '5905 East Truman Road', 'Poplar Bluff', 'Butler', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(8, 'Fire Station # 12', '4242 Main Street', 'Kansas City', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0),
(9, 'City Hall', '3220 Bellview', 'Pine Bluff', 'Jackson', 'Mo', '64108', '', 0, '0000-00-00 00:00:00', 0);

INSERT INTO `#__ep_asset_type` (`id`, `description`, `notes`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 'Generator', 'To produce electricity for emergency workers and for homes without electricity', 0, '0000-00-00 00:00:00', 0),
(2, 'Compressor', 'For powering air tools and air blowing clean up', 0, '0000-00-00 00:00:00', 0),
(3, 'Cot', 'For setting up emergency sleeping facilities', 0, '0000-00-00 00:00:00', 0),
(4, 'Rain Coat', 'For emergency services personel and displaced homeowners', 0, '0000-00-00 00:00:00', 0),
(5, 'Chain Saw', 'For clearing fallen trees and cutting through wooden walls in houses for rescue.', 0, '0000-00-00 00:00:00', 0),
(6, 'Life Jacket', 'buoyancy device for floods', 0, '0000-00-00 00:00:00', 0),
(7, 'Air Matress', 'Emergency Sleeping and large floatation device', 0, '0000-00-00 00:00:00', 0),
(8, 'First Aid Kit', ' ', 0, '0000-00-00 00:00:00', 0),
(9, 'Porta-Potty', ' ', 0, '0000-00-00 00:00:00', 0),
(10, 'Heater', ' ', 0, '0000-00-00 00:00:00', 0),
(11, 'Tent', ' ', 0, '0000-00-00 00:00:00', 0),
(12, 'Wrecking Bar', ' ', 0, '0000-00-00 00:00:00', 0),
(13, 'Front End Loader', ' ', 0, '0000-00-00 00:00:00', 0),
(14, 'Tractor', ' ', 0, '0000-00-00 00:00:00', 0),
(15, 'Rubber Boots', ' ', 0, '0000-00-00 00:00:00', 0),
(16, 'Blower', 'For Clean up', 0, '0000-00-00 00:00:00', 0),
(17, 'Night Vision Goggles', 'Search and Rescue', 0, '0000-00-00 00:00:00', 0),
(18, 'Skill Saw', ' ', 0, '0000-00-00 00:00:00', 0);

INSERT INTO `#__ep_inventory` (`id`, `description`, `asset_type`, `location`, `lastlocation`, `athome`, `dateinservice`, `datecheckedout`, `dateexpectedback`, `notes`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 'Orange ', 1, 5, '', 'Y', '2009-09-01 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(2, 'Yellow', 10, 5, '', 'Y', '2009-09-17 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(3, 'Clear Disposable', 4, 5, 'golf course flood training', 'N', '2009-09-22 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '   ', 0, '0000-00-00 00:00:00', 0),
(4, 'Blue', 9, 5, '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(5, 'Red Vest', 6, 5, '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(6, 'Orange', 5, 5, '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(7, 'Black on Trailer', 2, 2, '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0),
(8, 'Yellow', 2, 2, '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' ', 0, '0000-00-00 00:00:00', 0);

INSERT INTO `#__ep_keyword` (`id`, `asset_type`, `description`, `typeofdata`, `notes`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 2, 'Manufacturer', 'A', 'Black & Decker\r\nRolm', 0, '0000-00-00 00:00:00', 0),
(2, 2, 'Horse Power', 'A', '  ', 0, '0000-00-00 00:00:00', 0),
(3, 2, 'Hose Size', 'A', '3/4 Inch\r\n1 Inch ', 0, '0000-00-00 00:00:00', 0),
(4, 2, 'Fuel', 'A', 'Gas Diesel Electric', 0, '0000-00-00 00:00:00', 0),
(5, 7, 'Size', 'A', ' King, Queen, Double, Flotation', 0, '0000-00-00 00:00:00', 0),
(6, 7, 'Material', 'A', ' Canvas Plastic Rubber', 0, '0000-00-00 00:00:00', 0),
(7, 16, 'Power', 'A', ' Gas Electric Battery Premix', 0, '0000-00-00 00:00:00', 0),
(8, 16, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(9, 5, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(10, 5, 'Blade Length', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(12, 3, 'Size', 'A', ' Large Adult Adult Child', 0, '0000-00-00 00:00:00', 0),
(13, 3, 'Material', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(14, 8, 'Size', 'A', ' Small Large', 0, '0000-00-00 00:00:00', 0),
(15, 13, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(16, 13, 'Horse Power', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(17, 7, 'Fuel', 'A', ' Gas Diesel', 0, '0000-00-00 00:00:00', 0),
(18, 1, 'Fuel', 'A', ' Gas Diesel Solar', 0, '0000-00-00 00:00:00', 0),
(19, 1, 'Watts', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(20, 1, 'Amps', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(21, 1, 'Volts', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(22, 1, 'Trailer', 'A', ' Yes No', 0, '0000-00-00 00:00:00', 0),
(23, 10, 'Fuel', 'A', ' Gas Electric Kerosene', 0, '0000-00-00 00:00:00', 0),
(24, 10, 'BTU', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(25, 6, 'Size', 'A', ' Adult Child', 0, '0000-00-00 00:00:00', 0),
(26, 17, 'Type', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(27, 17, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(28, 4, 'Size', 'A', '  Adult Child Small Medium Large X-Large', 0, '0000-00-00 00:00:00', 0),
(29, 7, 'Color', 'A', ' Yellow Orange White Clear', 0, '0000-00-00 00:00:00', 0),
(30, 15, 'Size', 'A', ' 10 12 8 6 ', 0, '0000-00-00 00:00:00', 0),
(31, 15, 'Height', 'A', ' Knee High Waders', 0, '0000-00-00 00:00:00', 0),
(32, 18, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(33, 18, 'Blade Size', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(34, 11, 'Capacity', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(35, 7, 'Height', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(36, 7, 'Material', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(37, 14, 'Manufacturer', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(38, 14, 'Horse Power', 'A', ' ', 0, '0000-00-00 00:00:00', 0),
(39, 7, 'Attachments', 'A', ' ', 0, '0000-00-00 00:00:00', 0);

INSERT INTO `#__ep_specifications` (`id`, `inventory_id`, `asset_type`, `keyword_id`, `value`, `checked_out`, `checked_out_time`, `published`) VALUES
(1, 1, 1, 20, '100', 0, '0000-00-00 00:00:00', 0),
(2, 1, 1, 18, 'Gas', 0, '0000-00-00 00:00:00', 0),
(3, 1, 1, 22, 'Yes', 0, '0000-00-00 00:00:00', 0),
(4, 1, 1, 21, '220', 0, '0000-00-00 00:00:00', 0),
(5, 1, 1, 19, '1000', 0, '0000-00-00 00:00:00', 0),
(6, 2, 10, 24, '1200', 0, '0000-00-00 00:00:00', 0),
(7, 2, 10, 23, 'Kerosene', 0, '0000-00-00 00:00:00', 0),
(8, 3, 4, 28, 'X-Large', 0, '0000-00-00 00:00:00', 0),
(9, 5, 6, 25, 'Adult', 0, '0000-00-00 00:00:00', 0),
(10, 6, 5, 10, '20 Inches', 0, '0000-00-00 00:00:00', 0),
(11, 6, 5, 9, 'Pulan', 0, '0000-00-00 00:00:00', 0),
(12, 7, 2, 4, 'gas', 0, '0000-00-00 00:00:00', 0),
(13, 7, 2, 2, '30', 0, '0000-00-00 00:00:00', 0),
(14, 7, 2, 3, '1 Inch ', 0, '0000-00-00 00:00:00', 0),
(15, 7, 2, 1, 'Zen', 0, '0000-00-00 00:00:00', 0),
(16, 7, 2, 11, '', 0, '0000-00-00 00:00:00', 0),
(17, 8, 2, 4, 'Gas', 0, '0000-00-00 00:00:00', 0),
(18, 8, 2, 2, '25', 0, '0000-00-00 00:00:00', 0),
(19, 8, 2, 3, '1 Inch ', 0, '0000-00-00 00:00:00', 0),
(20, 8, 2, 1, 'Rolm', 0, '0000-00-00 00:00:00', 0);
