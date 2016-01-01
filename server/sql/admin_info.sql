use qqxc;

CREATE TABLE admin_info (
	id int primary key auto_increment,
    admin_id int not null,
    nickname varchar(32) not null,
    avatar varchar(128) default '',
    openid varchar(32) unique not null,
    auth tinyint not null,
    admin_state tinyint not null default 0,
    register_time int(32) not null,
    expire timestamp not null
);