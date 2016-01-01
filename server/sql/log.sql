use qqxc;

CREATE TABLE log (
	id int primary key auto_increment,
    name varchar(32) not null,
    IP_addr varchar(32) not null,
    action varchar(32) not null,
    content varchar(32) not null,
    remark text,
    level tinyint not null default 0,
    create_time int(32) not null
);