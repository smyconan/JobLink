insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `qualification`, `resume`) 
				values	('thk-1','spwd1','Tom Hanks', 'NYU', 'CS', 3.3, 'programming', '3', 'blank resume');
insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `qualification`, `resume`) 
				values ('bpt-2','spwd2','Brad Pitt', 'Columbia', 'CS', 3.8, 'CV', '235','computer vision' );
insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `qualification`, `resume`) 
				values ('tmrb-3','spwd3','Tim Robbins', 'Georgia', 'EE', 3.5, 'Fourier', '56', 'blank resume');
insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `resume`) 
				values ('egr-4','spwd4','Eva Green', 'Rutgers', 'CS', 3.2, 'game', 'blank resume');
insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `qualification`, `resume`) 
				values ('sgd-5','spwd5','Sarah Gadon', 'NYU', 'CS', 3.8, 'programming, DB, CV, security', '12346', 'database systems');
insert into `student` (`username`, `spwd`, `realname`, `university`, `major`, `GPA`, `interest`, `qualification`, `resume`) 
				values ('nn-6','spwd6','Ni Ni', 'NYU', 'CE', 3.7, 'FPGA', '567', 'blank resume');


insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('1', '4', '2018-02-01 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('1', '5', '2018-02-02 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('2', '5', '2018-02-03 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('2', '6', '2018-02-04 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('4', '5', '2018-02-05 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('5', '6', '2018-02-06 00:00:00', 'accpeted');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('1', '2', '2018-02-02 07:00:00', 'read');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('4', '6', '2018-02-05 01:00:00', 'read');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('1', '3', '2018-02-03 00:00:00', 'unread');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('6', '3', '2018-02-07 00:00:00', 'unread');
insert into `friendRequest` (`sidFrom`, `sidTo`, `frtime`, `frstatus`) values ('6', '1', '2018-04-07 00:00:00', 'unread');


insert into `friend` (`sid1`,`sid2`) values ('1', '4');
insert into `friend` (`sid1`,`sid2`) values ('1', '5');
insert into `friend` (`sid1`,`sid2`) values ('2', '5');
insert into `friend` (`sid1`,`sid2`) values ('2', '6');
insert into `friend` (`sid1`,`sid2`) values ('4', '5');
insert into `friend` (`sid1`,`sid2`) values ('5', '6');


insert into `company` (`cname`,`cpwd`, `industry`, `location`) values ('Microsoft', 'pwdForMS', 'Software, Hardware', 'Washington');
insert into `company` (`cname`,`cpwd`, `industry`, `location`) values ('Apple', 'pwdForAPPLE', 'Software,  Internet', 'California');
insert into `company` (`cname`,`cpwd`, `industry`, `location`) values ('Snap', 'pwdForSnap', 'Internet', 'California');


insert into `follow` (`sid`,`cid`) values ('1', '3');
insert into `follow` (`sid`,`cid`) values ('1', '2');
insert into `follow` (`sid`,`cid`) values ('2', '3');
insert into `follow` (`sid`,`cid`) values ('3', '1');
insert into `follow` (`sid`,`cid`) values ('3', '2');
insert into `follow` (`sid`,`cid`) values ('4', '1');
insert into `follow` (`sid`,`cid`) values ('4', '2');
insert into `follow` (`sid`,`cid`) values ('4', '3');
insert into `follow` (`sid`,`cid`) values ('5', '1');
insert into `follow` (`sid`,`cid`) values ('5', '2');
insert into `follow` (`sid`,`cid`) values ('5', '3');
insert into `follow` (`sid`,`cid`) values ('6', '1');
insert into `follow` (`sid`,`cid`) values ('6', '2');
insert into `follow` (`sid`,`cid`) values ('6', '3');


insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('1', 'Seattle', 'engineer', '90000', 'higher than BS degree', '2018-04-08 00:00:00', 'database');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('2', 'Cupertino', 'engineer', '100000', 'at least MS in CS', '2018-04-10 00:00:00', 'java');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('2', 'Cupertino', 'manager', '500000', 'at least senior engineer', '2018-04-10 09:00:00', 'product department');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('3', 'Los Angeles', 'engineer', '90000', 'MS in CS or MS in CE', '2018-04-11 00:00:00', 'web');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('1', 'Seattle', 'engineer', '90000', 'higher than BS degree', '2018-04-16 00:00:00', 'database');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('2', 'Cupertino', 'engineer', '100000', 'at least MS in CS', '2018-04-17 00:00:00', 'java');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('2', 'Cupertino', 'manager', '500000', 'at least senior engineer', '2018-04-16 09:00:00', 'product department');
insert into `joba` (`cid`,`location`,`title`,`salary`,`requirement`,`jatime`,`description`) 
		values ('3', 'Los Angeles', 'engineer', '90000', 'MS in CS or MS in CE', '2018-04-15 00:00:00', 'web');


insert into `message` (`sidFrom`, `sidTo`, `mtime`, `mstatus`, `content`) values ('1', '5', '2018-02-02 00:00:00', 'read', 'Hi, Sarah. Do you have MS new notifications?');
insert into `message` (`sidFrom`, `sidTo`, `mtime`, `mstatus`, `content`) values ('5', '1', '2018-02-02 08:00:00', 'read', 'Yes.');
insert into `message` (`sidFrom`, `sidTo`, `mtime`, `mstatus`, `content`) values ('1', '5', '2018-02-02 10:00:00', 'unread', 'Thank you!');


# empty notification

# empty application