use qqxc;

drop table coach_pass;

create table coach_pass (
	id int primary key auto_increment,
	coach_id int not null,
	car_type char(2) not null comment '车型',
	subject char(1) not null comment '科目',
	pass_num int not null default 0 comment '通过人数',
	total_num int not null default 1 comment '总人数'
)