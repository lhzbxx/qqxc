use qqxc;

create table label (
	id int primary key auto_increment,
	content varchar(32) not null unique comment '标签内容',
	type char(1) comment '标签类型'
)