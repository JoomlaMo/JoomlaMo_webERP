CREATE TABLE `#__jinv_inventory` (
  `id` int(11) NOT NULL auto_increment,
  `description` text NOT NULL,
  `partnumber` text NOT NULL,
  `onhand` int(11) NOT NULL,
  `reorderlevel` int(11) NOT NULL,
  `reorderquantity` int(11) NOT NULL,
  `location_id` INTEGER UNSIGNED NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  `published` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE `#__jinv_usage` (
  `id` int(11) NOT NULL auto_increment,
  `reference` text NOT NULL,
  `partnumber` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `location_id` INTEGER UNSIGNED NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  `published` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE `#__jinv_orders` (
  `id` int(11) NOT NULL auto_increment,
  `reference` text NOT NULL,
  `partnumber` text NOT NULL,
  `quantityordered` int(11) NOT NULL,
  `quantityreceived` int(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `filled` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  `location_id` INTEGER UNSIGNED NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  `published` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
CREATE TABLE `#__jinv_receipts` (
  `id` int(11) NOT NULL auto_increment,
  `reference` text NOT NULL,
  `partnumber` text NOT NULL,
  `quantityreceived` int(11) NOT NULL,
  `invoiced` int(1) NOT NULL DEFAULT 0,
  `date` DATETIME NOT NULL,
  `location_id` INTEGER UNSIGNED NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  `published` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

