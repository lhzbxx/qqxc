use qqxc;

CREATE TABLE user_notice (
	id int primary key auto_increment,
    user_id int not null unique,
    content text not null,
    sender varchar(20) not null default 'system',
    state tinyint not null default 0,
    create_time int(32) not null
);