use qqxc;

CREATE TABLE user (
	id int primary key auto_increment,
	phone varchar(20) not null unique,
    passwd varchar(64) not null,
    salt varchar(32) not null
);