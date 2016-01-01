use qqxc;

CREATE TABLE admin (
	id int primary key auto_increment,
	username varchar(20) not null unique,
    passwd varchar(64) not null,
    salt varchar(32) not null
);