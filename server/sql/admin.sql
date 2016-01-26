use qqxc;

drop table admin;

CREATE TABLE admin (
	id int primary key auto_increment,
	username varchar(20) not null unique comment '账号',
    passwd varchar(32) not null comment '密码',
    salt varchar(32) not null comment '加密盐'
);