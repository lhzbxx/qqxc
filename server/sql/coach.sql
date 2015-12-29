use qqxc;

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