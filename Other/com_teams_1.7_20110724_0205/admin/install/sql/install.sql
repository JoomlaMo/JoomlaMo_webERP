CREATE TABLE  IF NOT EXISTS `#__team_games` (
  `GameID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Opponent` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Location` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Description` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `TeamID` decimal(18,0) DEFAULT NULL,
  `UniformID` decimal(18,0) DEFAULT NULL,
  `Directions` longtext CHARACTER SET utf8,
  `Us` mediumint(9) DEFAULT '0',
  `Them` mediumint(9) DEFAULT '0',
  `Notes` text CHARACTER SET utf8,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`GameID`),
  KEY `Date` (`Date`),
  KEY `TeamID` (`TeamID`),
  KEY `UniformID` (`UniformID`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE  IF NOT EXISTS `#__team_leagues` (
  `LeagueID` int(11) NOT NULL AUTO_INCREMENT,
  `LeagueName` varchar(100) NOT NULL,
  `LeagueDescription` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`LeagueID`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Insert LeagueID in team records';

CREATE TABLE  IF NOT EXISTS `#__team_lineup` (
  `GameStatID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PlayerID` decimal(18,0) NOT NULL DEFAULT '0',
  `PlayerNumber` int(11) DEFAULT NULL,
  `TeamID` decimal(18,0) NOT NULL DEFAULT '0',
  `GameID` decimal(18,0) NOT NULL DEFAULT '0',
  `BattingOrder` int(11) NOT NULL DEFAULT '0',
  `Position` int(11) NOT NULL DEFAULT '0',
  `AtBat` int(11) DEFAULT NULL,
  `Outs` int(11) DEFAULT NULL,
  `StrikeOuts` int(11) DEFAULT NULL,
  `Walks` int(11) DEFAULT NULL,
  `HitByPitch` int(11) DEFAULT NULL,
  `FieldersChoice` int(11) DEFAULT NULL,
  `OnByError` int(11) DEFAULT NULL,
  `Singles` int(11) DEFAULT NULL,
  `Doubles` int(11) DEFAULT NULL,
  `Triples` int(11) DEFAULT NULL,
  `HomeRuns` int(11) DEFAULT NULL,
  `StolenBases` int(11) DEFAULT NULL,
  `RunsBattedIn` int(11) DEFAULT NULL,
  `Runs` int(11) DEFAULT NULL,
  `OutsPitched` int(11) DEFAULT NULL,
  `EarnedRuns` int(11) DEFAULT NULL,
  `BenchedInnings` int(11) DEFAULT NULL,
  `PlayedInnings` int(11) DEFAULT NULL,
  `Sacrifice` int(11) DEFAULT NULL,
  `SacrificeBunt` int(11) DEFAULT NULL,
  `PitcherWalks` int(11) DEFAULT NULL,
  `PitcherStrikeOuts` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`GameStatID`),
  KEY `TeamID` (`TeamID`),
  KEY `GameID` (`GameID`),
  KEY `PlayerID` (`PlayerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS  `#__team_player` (
  `PlayerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `LastName` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Notes` text CHARACTER SET utf8,
  `Active` char(1) CHARACTER SET utf8 NOT NULL DEFAULT 'Y',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`PlayerID`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS  `#__team_playernumbers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `PlayerID` decimal(18,0) DEFAULT NULL,
  `UniformID` decimal(18,0) DEFAULT NULL,
  `Number` decimal(18,0) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `UniformID` (`UniformID`),
  KEY `PlayerID` (`PlayerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE  IF NOT EXISTS `#__team_positions` (
  `PositionID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`PositionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE  IF NOT EXISTS `#__team_teamplayer` (
  `TeamPlayerID` int(11) NOT NULL AUTO_INCREMENT,
  `TeamID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`TeamPlayerID`),
  KEY `TeamID` (`TeamID`),
  KEY `PlayerID` (`PlayerID`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE  IF NOT EXISTS `#__team_teams` (
  `TeamID` bigint(20) NOT NULL AUTO_INCREMENT,
  `TeamName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `TeamDescription` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `TeamLeague` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `LoftName` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `City` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `State` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `ZipCode` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `Phone` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`TeamID`),
  KEY `userid` (`userid`),
  KEY `TeamLeague` (`TeamLeague`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE  IF NOT EXISTS `#__team_uniforms` (
  `UniformID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UniformDescription` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `TeamID` decimal(18,0) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`UniformID`),
  KEY `TeamID` (`TeamID`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;