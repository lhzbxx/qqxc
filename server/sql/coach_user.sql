use qqxc;

CREATE TABLE coach_user (
	id int primary key auto_increment,
    user_id int not null,
    coach_id int not null,
    deal_type tinyint default 0,
    create_time int(32) not null
);