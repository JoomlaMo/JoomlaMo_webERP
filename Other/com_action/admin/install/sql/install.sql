CREATE TABLE `#__a_action` (	
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime default NULL,
  `DoneTime` datetime default NULL,
  `Notes` Text NOT NULL,
  `PersonID` INT(11) NOT NULL,
  `CustomerOrderNumber` VARCHAR(20) NULL,
  `SalesOrderNumber` VARCHAR(20) NULL,
  `InvoiceNumber` VARCHAR(20) NULL,
  `JobID` INT(11) NULL,
  `ProcessID` INT(11) NOT NULL,
  `Start` datetime default NULL,
  `Due` datetime default NULL,
  `Complete` VARCHAR(1) NULL,
  `Thread` INT(11) NOT NULL,
  `CompletedBy` INT(11) NOT NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_job` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `description` Text NOT NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_process` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(100) NOT NULL,
  `Instruction` Text NULL,
  `EstimatedTime` time default NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_checklist` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `EstimatedTime` time default NULL,
  `ProcessID` INT(11) NOT NULL,
  `ThreadID` INT(11) NOT NULL,
  `ActionID` INT(11) NOT NULL,
  `ProcessCheckListID` INT(11) NOT NULL,
  `Checked` VARCHAR(1) NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  `Ordering` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_precedent` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `PrecedentID` INT(11) NOT NULL,
  `ProcessID` INT(11) NOT NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_processassignment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `PersonID` INT(11) NOT NULL,
  `ProcessID` INT(11) NOT NULL,
  `Type` VARCHAR(1) NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_processchecklist` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(100) NOT NULL,
  `Instruction` Text NULL,
  `ProcessID` INT(11) NOT NULL,
  `Ordering` INT(11) NOT NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `#__a_processlink` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(100) NOT NULL,
  `URL` VARCHAR(200) NOT NULL,
  `ProcessCheckListID` INT(11) NOT NULL,
  `Ordering` INT(11) NOT NULL,
  `checked_out` int(11) default NULL,
  `checked_out_time` datetime default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;