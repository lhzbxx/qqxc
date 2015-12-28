use qqxc;

CREATE TABLE user_info (
	id int primary key auto_increment,
    nickname varchar(32) not null,
    phone varchar(32) not null,
    register_time timestamp not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    expire timestamp not null
);