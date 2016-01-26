use qqxc;

drop table coach_price;

create table coach_price (
	id int primary key auto_increment,
	coach_id int not null,
	car_type char(2) not null COMMENT '教车类型',
	price varchar(10) not null COMMENT '价格'
)