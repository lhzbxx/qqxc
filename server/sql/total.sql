use qqxc;

drop table user;

CREATE TABLE user (
	id int primary key auto_increment,
	phone varchar(20) not null unique,
    passwd varchar(64) not null,
    salt varchar(32) not null
);

drop table user_info;

CREATE TABLE user_info (
	id int primary key auto_increment,
    nickname varchar(32) not null,
    phone varchar(32) not null,
    register_time timestamp not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    expire timestamp not null
);

drop table feedback;

CREATE TABLE feedback (
	id int primary key auto_increment,
    phone varchar(32),
    content text,
    create_time timestamp not null
);