use qqxc;

CREATE TABLE user_info (
	id int primary key auto_increment,
    user_id int not null,
    nickname varchar(32) not null,
    phone varchar(32) not null unique,
    register_time int(32) not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    expire timestamp not null
);