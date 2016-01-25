use qqxc;

create table coach_label (
	id int primary key auto_increment,
	coach_id int not null unique,
	label_id int not null unique,
	num int default 1 comment '数量'
)