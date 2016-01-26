use qqxc;

drop table driver_school;

create table driver_school (
	id int primary key auto_increment,
	name varchar(32) not null unique comment '驾校名称',
	lat float comment '经度',
	lng float comment '纬度',
	addr_name varchar(32) comment '地址名称'
)