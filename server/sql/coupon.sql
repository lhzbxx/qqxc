use qqxc;

CREATE TABLE coupon(
	id int primary key auto_increment,
    user_id1 int not null,
    user_id2 int,
    coupon_type tinyint not null default 0,
    coupon_code varchar(32) not null,
    discount float not null,
    state tinyint not null default 0,
    create_time int(32) not null
);