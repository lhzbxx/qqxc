use qqxc;

DROP TABLE account;

create table account (
	id int primary key auto_increment,
	cid int not null comment '用户ID',
	type char(1) comment '用户类型，C 教练，U 用户，A 管理员',
	balance varchar(10) comment '账户余额' DEFAULT 0
)