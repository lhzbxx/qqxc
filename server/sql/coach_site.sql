use qqxc;

create table coach_site (
	id int primary key auto_increment,
	coach_id int not null,
	lat float comment '经度',
	lng float comment '纬度',
	address varchar(32) comment '练车场地'
)