use qqxc;

drop table user_info;

CREATE TABLE user_info (
	id int primary key,
    nickname varchar(32) not null,
    register_time timestamp not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    expire timestamp not null
);