use qqxc;

CREATE TABLE coupon(
	id int primary key auto_increment,
    user_id1 int,
    user_id2 int,
    discount float not null,
    state tinyint not null default 0,
    create_time int(32) not null
);