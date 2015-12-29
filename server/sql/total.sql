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
    phone varchar(32) not null unique,
    register_time int(32) not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    expire timestamp not null
);

drop table feedback;

CREATE TABLE feedback (
	id int primary key auto_increment,
    phone varchar(32),
    content text not null,
    create_time int(32) not null
);

drop table coach;

CREATE TABLE coach (
	id int primary key auto_increment,
	phone varchar(20) not null unique,
    name varchar(20) not null,
    seniority tinyint default 0,
    car_type text,
    school varchar(64),
    avatar varchar(128) default '',
    sub2pass int(8) default 0,
    sub2total int(8) default 0,
    sub3pass int(8) default 0,
    sub3total int(8) default 0,
    service text,
    address varchar(128),
    latitude float,
    longitude float,
    star_total int(8) default 5,
    star_num int(8) default 0,
    status tinyint default 0,
    register_time int(32) not null
);

drop table coach_comment;

CREATE TABLE coach_comment (
	id int primary key auto_increment,
    user_id int not null,
    coach_id int not null,
    content text not null,
    star int not null default 5,
    create_time int(32) not null
);

drop table coach_user;

CREATE TABLE coach_user (
	id int primary key auto_increment,
    user_id int not null,
    coach_id int not null,
    deal_type tinyint default 0,
    process tinyint default 0,
    create_time int(32) not null
);