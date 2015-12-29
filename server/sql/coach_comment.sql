use qqxc;

CREATE TABLE coach_comment (
	id int primary key auto_increment,
    user_id int not null,
    coach_id int not null,
    content text not null,
    star int not null default 5,
    create_time int(32) not null
);