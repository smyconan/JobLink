# SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS student;
CREATE TABLE `student` (
	`sid` INT NOT NULL auto_increment,
    `username` VARCHAR(45) NOT NULL,
    `spwd` VARCHAR(45) NOT NULL,
    `realname` VARCHAR(45) NULL,
    `university` VARCHAR(45) NULL,
    `major` VARCHAR(45) NULL,
	`GPA` DECIMAL(3,2) NULL,
	`interest` VARCHAR(255) NULL,
	`qualification` VARCHAR(255) NULL,
	`resume` LONGTEXT NULL,
    `private` BOOLEAN NOT NULL default 0,
    PRIMARY KEY (`sid`)
);

DROP TABLE IF EXISTS company;
CREATE TABLE `company` (
	`cid` INT NOT NULL auto_increment,
    `cname` VARCHAR(45) NOT NULL,
    `cpwd` VARCHAR(45) NOT NULL,
    `industry` VARCHAR(255) NULL,
    `location` VARCHAR(255) NULL,
    PRIMARY KEY (`cid`)
);

DROP TABLE IF EXISTS friend;
CREATE TABLE `friend` (
    `sid1` INT NOT NULL,
    `sid2` INT NOT NULL,
    PRIMARY KEY (`sid1`, `sid2`),
    FOREIGN KEY (`sid1`) REFERENCES `student` (`sid`),
    FOREIGN KEY (`sid2`) REFERENCES `student` (`sid`)
);

DROP TABLE IF EXISTS friendRequest;
CREATE TABLE `friendRequest` (
    `sidFrom` INT NOT NULL,
    `sidTo` INT NOT NULL,
    `frtime` DATETIME NULL default now(),
	`frstatus` ENUM('unread', 'read', 'accpeted', 'rejected') NULL default 'unread',
    PRIMARY KEY (`sidFrom`, `sidTo`),
    FOREIGN KEY (`sidFrom`) REFERENCES `student` (`sid`),
    FOREIGN KEY (`sidTo`) REFERENCES `student` (`sid`)
);

DROP TABLE IF EXISTS joba;
CREATE TABLE `joba` (
    `jid` INT NOT NULL auto_increment,
    `cid` INT NOT NULL,
	`location` VARCHAR(45) NULL,
	`title` VARCHAR(45) NULL,
	`salary` VARCHAR(45) NULL,
	`requirement` VARCHAR(255) NULL,
    `jatime` DATETIME NULL default now(),
	`description` VARCHAR(255) NULL,
    `expired` BOOLEAN NOT NULL default 0,
    PRIMARY KEY (`jid`),
    FOREIGN KEY (`cid`) REFERENCES `company` (`cid`)
);

DROP TABLE IF EXISTS message;
CREATE TABLE `message` (
    # `mid` INT NOT NULL auto_increment,
	`sidFrom` INT NOT NULL,
    `sidTo` INT NOT NULL,
	# `jid` INT NULL,
	`mtime` DATETIME NOT NULL default now(),
	`mstatus` ENUM('unread', 'read') NULL default 'unread',
	`content` VARCHAR(255) NULL,
	# PRIMARY KEY (`mid`),
    PRIMARY KEY (`sidFrom`, `sidTo`, `mtime`),
    FOREIGN KEY (`sidFrom`) REFERENCES `student` (`sid`),
    FOREIGN KEY (`sidTo`) REFERENCES `student` (`sid`)
    # FOREIGN KEY (`jid`) REFERENCES `joba` (`jid`)
);

DROP TABLE IF EXISTS follow;
CREATE TABLE `follow` (
    `sid` INT NOT NULL,
    `cid` INT NOT NULL,
    PRIMARY KEY (`sid`, `cid`),
    FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
    FOREIGN KEY (`cid`) REFERENCES `company` (`cid`)
);

DROP TABLE IF EXISTS notification;
CREATE TABLE `notification` (
    `jid` INT NOT NULL,
    `sid` INT NOT NULL,
	`cid` INT NOT NULL,
    `nftime` DATETIME NULL default now(),
	`nfstatus` ENUM('unread', 'read', 'applied') NULL default 'unread',
    PRIMARY KEY (`jid`, `sid`),
    FOREIGN KEY (`cid`, `jid`) REFERENCES `joba` (`cid`, `jid`),
    FOREIGN KEY (`sid`) REFERENCES `student` (`sid`)
);

DROP TABLE IF EXISTS application;
CREATE TABLE `application` (
    `jid` INT NOT NULL,
    `sid` INT NOT NULL,
	`cid` INT NOT NULL,
	`aptime` DATETIME NULL default now(),
	`apstatus` ENUM('unread', 'read') NULL default 'unread',
    PRIMARY KEY (`jid`, `sid`),
    FOREIGN KEY (`cid`, `jid`) REFERENCES `joba` (`cid`, `jid`),
    FOREIGN KEY (`sid`) REFERENCES `student` (`sid`)
);





