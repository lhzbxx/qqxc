use qqxc;

drop table coach_car;

create table coach_car (
	id int primary key auto_increment,
	coach_id int not null,
	car_name varchar(20) comment '车辆名称',
	car_plate varchar(10) comment '车牌号'
)